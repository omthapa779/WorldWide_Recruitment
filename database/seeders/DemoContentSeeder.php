<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Hero;
use App\Models\Job;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

/**
 * LOCAL DEVELOPMENT FIXTURE — DO NOT RUN AGAINST PRODUCTION.
 *
 * Job titles, position counts and news headlines are taken from wrsnepal.com.
 * Everything else — the job descriptions, age ranges, language requirements,
 * contract terms and article bodies — is ILLUSTRATIVE TEXT written to give
 * the layout realistic shapes to render. None of it is client-supplied and
 * none of it should ever reach a live site.
 *
 * Real content comes from the admin panel.
 *
 *   php artisan db:seed --class=DemoContentSeeder
 */
class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        Hero::updateOrCreate(
            ['title' => 'Your journey to overseas work starts here — with WRS Nepal.'],
            [
                'title_ja' => '海外就労への一歩を、WRSネパールと共に。',
                'button_cta' => 'Get Started',
                'button_cta_ja' => 'まずはご相談',
                'image_path' => 'demo/hero_japan.jpg',
            ],
        );

        Ad::updateOrCreate(
            ['title' => 'Now recruiting for Japan'],
            ['image_path' => 'demo/About_page.jpg'],
        );

        // The first four carry Japanese translations; the rest are left
        // English-only on purpose, so the Japanese site exercises its
        // fall-back path as well as its translated path.
        $jobs = [
            ['Construction Worker', '建設作業員', 'Japan', 20, 'demo/deployment.jpg', 1, 1,
                '<p>We are recruiting <strong>construction workers</strong> for a contractor operating across the Kanto region of Japan. Successful candidates will join ongoing residential and infrastructure projects.</p><h2>Requirements</h2><ul><li>Age 20–38</li><li>Physically fit, able to work outdoors</li><li>Basic Japanese (N5 level) preferred, training provided</li><li>Prior construction experience an advantage</li></ul><h2>What we offer</h2><ul><li>Contract as per Japanese labour law</li><li>Accommodation support on arrival</li><li>Pre-departure language and culture training</li></ul>',
                '<p>関東一円で施工を行う建設会社にて、<strong>建設作業員</strong>を募集しています。住宅および社会インフラの工事現場に配属となります。</p><h2>応募条件</h2><ul><li>20歳〜38歳</li><li>屋外作業に対応できる健康状態の方</li><li>日本語能力 N5 程度（出発前研修あり）</li><li>建設業のご経験がある方は優遇</li></ul><h2>待遇</h2><ul><li>日本の労働法令に基づく雇用契約</li><li>入国後の住居手配のサポート</li><li>出発前の語学・生活文化研修</li></ul>'],
            ['Food Server', '飲食スタッフ', 'Japan', 50, 'demo/overseas_recruitment.jpg', 1, 2,
                '<p>A national restaurant group is hiring <strong>food service staff</strong> for outlets in Tokyo and Osaka. This is a customer-facing role suited to candidates comfortable with a fast-paced service environment.</p><h2>Requirements</h2><ul><li>Age 20–35</li><li>Conversational Japanese preferred</li><li>Hospitality experience welcome but not required</li></ul>',
                '<p>全国展開する飲食チェーンにて、東京・大阪の店舗で勤務する<strong>ホールスタッフ</strong>を募集しています。お客さまと接する機会の多い、活気のある職場です。</p><h2>応募条件</h2><ul><li>20歳〜35歳</li><li>日常会話程度の日本語ができる方を優遇</li><li>飲食業のご経験は不問です</li></ul>'],
            ['Caretaker', '介護スタッフ', 'Japan', 25, 'demo/documentation.jpg', 1, 3,
                '<p>Openings for <strong>caregiving staff</strong> at licensed care facilities. Full training is provided in Japan; candidates must complete the pre-departure caregiving orientation with us before deployment.</p><h2>Requirements</h2><ul><li>Age 20–40</li><li>Patient, reliable and comfortable with elderly care</li><li>Japanese language training completed through WRS</li></ul>',
                '<p>認可を受けた介護施設にて、<strong>介護スタッフ</strong>を募集しています。就業先での研修制度が整っており、出発前には当社の介護研修を修了していただきます。</p><h2>応募条件</h2><ul><li>20歳〜40歳</li><li>高齢者の介護に誠実に向き合える方</li><li>当社の語学研修を修了された方</li></ul>'],
            ['Cleaner', '清掃スタッフ', 'UAE', 15, 'demo/why_us.jpg', 1, 4,
                '<p>Commercial <strong>cleaning staff</strong> required for a facilities management company in Dubai. Duty hours, overtime rates and accommodation are specified in the contract before signing.</p><h2>Requirements</h2><ul><li>Age 21–40</li><li>Basic English</li><li>Prior cleaning or housekeeping experience preferred</li></ul>',
                '<p>ドバイのビル管理会社にて、<strong>清掃スタッフ</strong>を募集しています。勤務時間・残業手当・住居については、ご署名前に契約書で明示いたします。</p><h2>応募条件</h2><ul><li>21歳〜40歳</li><li>簡単な英語ができる方</li><li>清掃・客室清掃のご経験がある方を優遇</li></ul>'],
            ['Factory Worker', null, 'Qatar', 20, 'demo/overseas_recruitment.jpg', 1, 5,
                '<p>Production line <strong>factory workers</strong> needed for a manufacturing plant in Doha. Two-year renewable contract with food and accommodation provided.</p><h2>Requirements</h2><ul><li>Age 21–40</li><li>Able to work rotating shifts</li><li>Prior factory experience preferred</li></ul>', null],
            ['Security Guard', null, 'Qatar', 12, 'demo/deployment.jpg', 0, 6,
                '<p>Licensed <strong>security guards</strong> required for commercial premises in Doha. Uniform, training and accommodation provided by the employer.</p><h2>Requirements</h2><ul><li>Age 23–40, minimum height 5&rsquo;6&rdquo;</li><li>Basic English</li><li>Clean police record</li></ul>', null],
            ['Hotel Housekeeping', null, 'UAE', 18, 'demo/documentation.jpg', 0, 7,
                '<p><strong>Housekeeping attendants</strong> for a four-star hotel group in Abu Dhabi. Split shifts, service charge and annual leave as per UAE labour law.</p>', null],
            ['Warehouse Operative', '倉庫スタッフ', 'Japan', 30, 'demo/why_us.jpg', 0, 8,
                '<p><strong>Warehouse and logistics operatives</strong> for a distribution centre in Chiba prefecture. Forklift certification supported after arrival.</p>',
                '<p>千葉県の物流センターにて、<strong>倉庫・物流スタッフ</strong>を募集しています。入国後のフォークリフト資格取得を支援します。</p>'],
        ];

        foreach ($jobs as $i => [$title, $titleJa, $country, $positions, $image, $featured, $order, $description, $descriptionJa]) {
            Job::updateOrCreate(
                ['title' => $title],
                [
                    'title_ja' => $titleJa,
                    'country' => $country,
                    'positions_left' => $positions,
                    'image_path' => $image,
                    'is_featured' => $featured,
                    'featured_order' => $order,
                    'description' => $description,
                    'description_ja' => $descriptionJa,
                    'posted_on' => Carbon::now()->subDays($i * 6 + 2),
                ],
            );
        }

        $news = [
            ['12 workers deployed to the Japanese construction industry',
                '建設分野へ12名を送り出しました',
                'demo/deployment.jpg', 4,
                '<p>WorldWide Recruitment Services has completed the deployment of <strong>12 Nepalese workers</strong> to a construction contractor in Japan. The group departed Kathmandu following the completion of their pre-departure orientation, language briefing and documentation.</p><p>Each worker holds a contract issued under Japanese labour law, with accommodation arranged by the employer for the first three months.</p><h2>What happens next</h2><p>Our Tokyo branch will conduct arrival check-ins during the first month, and remains the point of contact for both the workers and the employer throughout the contract.</p>',
                '<p>このたび当社より、日本の建設会社へ<strong>ネパール人労働者12名</strong>を送り出しました。出発前研修、語学研修、必要書類の手続きをすべて修了したうえで、カトマンズを出発しております。</p><p>12名全員が日本の労働法令に基づく雇用契約を締結しており、渡航後3か月間の住居は受け入れ企業さまにご手配いただいております。</p><h2>今後について</h2><p>入国後1か月間は東京支店の担当者が定期的に状況を確認いたします。契約期間中は、働く方と受け入れ企業さまの双方の窓口として対応を続けてまいります。</p>'],
            ['Three workers sent to a Fukuoka construction company',
                '福岡の建設会社へ3名が就業しました',
                'demo/overseas_recruitment.jpg', 18,
                '<p>Three candidates selected through our Kathmandu office have joined a construction company based in Fukuoka. All three completed skill testing and employer interviews in June, with documentation finalised the following month.</p><p>We would like to thank the employer for a straightforward and well-organised recruitment process.</p>',
                '<p>カトマンズ本社にて選考を行った3名が、福岡県の建設会社にて就業を開始いたしました。3名とも6月に技能試験と企業面接を修了し、翌月に書類手続きを完了しております。</p><p>円滑な採用手続きにご協力いただきました受け入れ企業さまに、心より御礼申し上げます。</p>'],
            ['Japanese partner company visits our training centre',
                '提携企業さまが研修センターをご視察されました',
                'demo/documentation.jpg', 36,
                '<p>Representatives from a partner company in Japan visited our training centre in Kathmandu to observe pre-departure training and meet shortlisted candidates in person.</p><p>The visit included a review of our language training curriculum and a discussion of upcoming demand across construction and manufacturing roles for the coming year.</p>',
                '<p>日本の提携企業さまのご担当者が、カトマンズの当社研修センターをご視察くださいました。出発前研修の様子をご覧いただき、選考中の候補者とも直接お会いいただいております。</p><p>当日は語学研修のカリキュラムについてもご確認いただき、来年度の建設・製造分野における採用計画について意見を交わしました。</p>'],
            ['Our new website is now live',
                null, 'demo/About_page.jpg', 52,
                '<p>We have launched a redesigned website, making it easier to browse current openings, understand our process and get in touch with either of our offices.</p><p>Job seekers can now review the full recruitment flow — from first consultation through to arrival and aftercare — before registering their interest.</p>', null],
            ['Pre-departure orientation schedule updated',
                null, 'demo/why_us.jpg', 70,
                '<p>The orientation schedule has been updated for the coming quarter. Candidates with confirmed placements should contact our Kathmandu office to confirm their session dates.</p>', null],
        ];

        foreach ($news as [$title, $titleJa, $image, $daysAgo, $content, $contentJa]) {
            News::updateOrCreate(
                ['title' => $title],
                [
                    'title_ja' => $titleJa,
                    'content' => $content,
                    'content_ja' => $contentJa,
                    'image_1' => $image,
                    'status' => 'published',
                    'posted_on' => Carbon::now()->subDays($daysAgo),
                ],
            );
        }
    }
}
