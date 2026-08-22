<?php

namespace App\Http\Controllers;

use App\Models\AdmissionDocument;
use App\Models\Commission;
use App\Models\Department;
use App\Models\Document;
use App\Models\DressCodeItem;
use App\Models\Faq;
use App\Models\PageSetting;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function showMainPage() {
        $contacts = Commission::all();
        $admissionDocuments = AdmissionDocument::all();
        $dressCodeItems = DressCodeItem::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->groupBy('group');
        return view('pages.main', compact('admissionDocuments', 'contacts', 'dressCodeItems'));
    }

    public function showSpecialitiesPage() {
        $specialities = Specialty::all();
        return view('pages.specialitites', compact('specialities'));
    }

    public function showSpecialityPage(Specialty $speciality) {
        $speciality->load([
            'cycleCommission.head',
            'department.head',
        ]);

        $universalDepartment = Department::with('head')
            ->where('is_universal', true)
            ->first();

        return view('pages.speciality', compact('speciality', 'universalDepartment'));
    }

    public function showDocumentsPage() {
        $documents = Document::all();
        return view('pages.documents', compact('documents'));
    }

    public function showFaqPage() {
        $faqs = Faq::all();
        return view('pages.faq', compact('faqs'));
    }

    public function showContactsPage() {
        $contacts = Commission::all();
        return view('pages.contacts', compact('contacts'));
    }

    public function showNumbersPage() {
        $specialities = Specialty::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.numbers', compact('specialities'));
    }

    public function showRatingPage(Request $request) {
        abort_unless(PageSetting::enabled(PageSetting::RATING), 404);

        $id = $request->query('id', '0');
        if (!in_array($id, ['0', '1'], true)) {
            $id = '0';
        }

        $content = Cache::remember("rating_content_{$id}_v6", 600, function () use ($id) {
            try {
                $response = Http::timeout(15)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                        'Accept' => 'text/html,application/xhtml+xml',
                    ])
                    ->get('https://mck-ktits.ru/rank', ['id' => $id]);

                if (!$response->successful()) {
                    return null;
                }

                return $this->extractRatingContent($response->body());
            } catch (\Throwable $e) {
                report($e);
                return null;
            }
        });

        return view('pages.rating', [
            'content'   => $content,
            'currentId' => $id,
        ]);
    }

    private function extractRatingContent(string $html): ?string
    {
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML(
            '<?xml encoding="utf-8" ?>' . $html,
            LIBXML_NOERROR | LIBXML_NOWARNING
        );
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);

        $candidates = [
            "//div[contains(concat(' ', normalize-space(@class), ' '), ' entry-content ')]",
            "//div[contains(concat(' ', normalize-space(@class), ' '), ' post-content ')]",
            "//article[starts-with(@id, 'post-')]",
            "//main[@id='main']",
            "//main[@id='content']",
            "//div[@id='content']",
            "//h1[contains(., 'Рейтинг')]/parent::*",
        ];

        foreach ($candidates as $query) {
            $nodes = $xpath->query($query);
            if ($nodes && $nodes->length > 0) {
                $contentNode = $nodes->item(0);
                $this->cleanRatingNode($contentNode, $xpath);
                $extracted = $dom->saveHTML($contentNode);
                return $this->postProcessRating($extracted);
            }
        }

        return null;
    }

    private function cleanRatingNode(\DOMNode $contentNode, \DOMXPath $xpath): void
    {
        $toRemove = new \SplObjectStorage();

        // 1. Все заголовки H1-H6 (наш собственный H1 уже не нужен, плюс там были три H6-уведомления и H2-подзаголовок)
        foreach ($xpath->query('.//h1 | .//h2 | .//h3 | .//h4 | .//h5 | .//h6', $contentNode) as $node) {
            $toRemove->attach($node);
        }

        // 1b. Параграфы/обёртки, в которых остался текст «Рейтинг абитуриентов»
        foreach ($xpath->query('.//p | .//div | .//strong | .//b | .//span', $contentNode) as $node) {
            $text = trim(preg_replace('/\s+/u', ' ', (string) $node->textContent));
            if ($text !== '' && mb_stripos($text, 'рейтинг абитуриентов') !== false && mb_strlen($text) <= 40) {
                $toRemove->attach($node);
            }
        }

        // 1c. Горизонтальные разделители и пустые параграфы/div, которые рисуются как тонкие линии над таблицей
        foreach ($xpath->query('.//hr', $contentNode) as $node) {
            $toRemove->attach($node);
        }
        foreach ($xpath->query('.//p | .//div', $contentNode) as $node) {
            // Если внутри есть таблица/список/картинка — не трогаем
            if ($xpath->query('.//table | .//img | .//ul | .//ol | .//figure | .//form', $node)->length > 0) {
                continue;
            }
            $text = trim(preg_replace('/\s+|&nbsp;|\x{00A0}/u', '', (string) $node->textContent));
            if ($text === '') {
                $toRemove->attach($node);
            }
        }

        // 1d. Пустые строки и пустые таблицы (часто оставляют тонкие границы над основной таблицей)
        foreach ($xpath->query('.//tr', $contentNode) as $node) {
            $text = trim(preg_replace('/\s+|&nbsp;|\x{00A0}/u', '', (string) $node->textContent));
            if ($text === '') {
                $toRemove->attach($node);
            }
        }
        foreach ($xpath->query('.//table', $contentNode) as $node) {
            $text = trim(preg_replace('/\s+|&nbsp;|\x{00A0}/u', '', (string) $node->textContent));
            if ($text === '') {
                $toRemove->attach($node);
            }
        }

        // 2. Все ссылки переключателя (любые href, где есть и "rank", и "id=")
        //    Удаляем И саму ссылку, И её ближайший контейнер p/div
        foreach ($xpath->query('.//a[contains(@href, "rank") and contains(@href, "id=")]', $contentNode) as $link) {
            $toRemove->attach($link);

            $parent = $link->parentNode;
            while ($parent && $parent !== $contentNode) {
                if (in_array($parent->nodeName, ['p', 'div'], true)) {
                    $toRemove->attach($parent);
                    break;
                }
                $parent = $parent->parentNode;
            }
        }

        $nodes = iterator_to_array($toRemove);
        foreach ($nodes as $node) {
            if ($node->parentNode) {
                try {
                    $node->parentNode->removeChild($node);
                } catch (\Throwable $e) {
                    // Узел уже удалён вместе с родителем
                }
            }
        }
    }

    private function postProcessRating(string $html): string
    {
        // На всякий случай переписываем оставшиеся ссылки на /rank?id=N → наш /rating?id=N
        $html = preg_replace(
            '#href=(["\'])\s*(?:https?:)?//?(?:mck-ktits\.ru)?/?rank/?\?id=(\d+)\s*\1#i',
            'href=$1/rating?id=$2$1',
            $html
        );

        // Остальные относительные ссылки (если попадутся) перенаправляем обратно на основной сайт
        $html = preg_replace(
            '#href=(["\'])/(?!rating)([^"\']*)\1#',
            'href=$1https://mck-ktits.ru/$2$1',
            $html
        );

        return $html;
    }
}
