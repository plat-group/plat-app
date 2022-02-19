<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\GameTemplate;
use App\Models\Order;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonAnswer;
use App\Models\Question;

class CreateTemplateLearningData extends Seeder
{
    const DEFAULT_COURSE_ID1 = 'basic-near-course-1';
    const DEFAULT_LESSON_ID1 = 'basic-near-lesson-1';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->createOrderData();

        $this->createCourseData();
        $this->createLessonData();
        $this->createQuestionAndAnswerData();

        $this->createCampaignData();
    }

    private function createCourseData()
    {
        $clientId = User::where('email', 'client@plats.network')->pluck('id')->first();

        $course = new Course();

        $course->id = self::DEFAULT_COURSE_ID1;
        $course->creator_id = $clientId;
        $course->name = 'Basic NEAR Protocol learning course';
        $course->description = 'Reimagine finance, creativity, and community with NEAR';
        $course->thumbnail = 'l2e/image/basic_near_course.png';
        $course->status = ON_POOL_STATUS;
        $course->save();
    }

    private function createLessonData()
    {
        $courseId = Course::pluck('id')->first();

        $lesson = new Lesson();
        $lesson->course_id = $courseId;
        $lesson->id = self::DEFAULT_LESSON_ID1;
        $lesson->name = 'What is NEAR?';
        $lesson->description = 'NEAR is a layer-1 blockchain that is simple to use, super fast, and incredibly secure. NEAR has been awarded the Climate Neutral Product Label from the South Pole and is actively helping users and developers reimagine finance, community, and creativity. Get to grips with what NEAR is, how it works, and discover why it’s so powerful for developers and users.';
        $lesson->thumbnail = 'l2e/image/1-What-is-NEAR.png';
        $lesson->content_url = 'l2e/video/what-is-near.mp4';
        $lesson->content_type = 0;
        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = $courseId;
        $lesson->id = 'basic-near-lesson-2';
        $lesson->name = 'NEAR Wallet & Staking';
        $lesson->description = 'NEAR wallet is a non-custodial, web-based application, that gives you full control over your assets — allowing you to create, play, and stake without restrictions. Sign-up takes just a few clicks, and once complete the world of staking rewards, NFTs, and more will be accessible and easy to use.';
        $lesson->thumbnail = 'l2e/image/2-Wallet.png';
        $lesson->content_url = 'l2e/video/NEAR-Wallet-Staking.mp4';
        $lesson->content_type = 0;
        $lesson->save();

        $lesson = new Lesson();
        $lesson->id = 'basic-near-lesson-3';
        $lesson->course_id = $courseId;
        $lesson->name = 'NEAR Sharding in a Nutshell';
        $lesson->description = "NEAR’s blockchain uses a revolutionary new type of sharding tool called Nightshade to help create infinite scalability and speed. In this lesson, we explore how it works and why it makes sure the NEAR network is primed for mass adoption.";
        $lesson->thumbnail = 'l2e/image/3-Sharding.png';
        $lesson->content_url = 'l2e/video/NEAR-Sharding-in-a Nutshell.mp4';
        $lesson->content_type = 0;
        $lesson->save();

        $lesson = new Lesson();
        $lesson->id = 'basic-near-lesson-4';
        $lesson->course_id = $courseId;
        $lesson->name = 'The Rainbow Bridge';
        $lesson->description = 'Rainbow Bridge is a gateway to other blockchains. The Bridge allows users to seamlessly connect NEAR with other blockchains allowing the movement of tokens into new ecosystems with little more than a few clicks. As a trustless, permissionless tool for cross-chain transfers, it’s the easiest, and simplest way to move assets between NEAR and Ethereum.';
        $lesson->thumbnail = 'l2e/image/4-Rainbow-Bridge.png';
        $lesson->content_url = 'l2e/video/The-Rainbow-Bridge.mp4';
        $lesson->content_type = 0;
        $lesson->save();

        $lesson = new Lesson();
        $lesson->id = 'basic-near-lesson-5';
        $lesson->course_id = $courseId;
        $lesson->name = 'What is Aurora?';
        $lesson->description = 'Aurora allows Ethereum\'s most popular applications to leverage NEAR\'s powerful blockchain protocol to dramatically increase scalability and efficiency while cutting fees by up to 99.99%.';
        $lesson->thumbnail = 'l2e/image/5-Aurora.png';
        $lesson->content_url = 'l2e/video/What-is-Aurora.mp4';
        $lesson->content_type = 0;
        $lesson->save();

        if(env('APP_ENV') === 'local') {
            $lesson = new Lesson();
            $lesson->id = 'basic-near-lesson-test';
            $lesson->course_id = $courseId;
            $lesson->name = 'Test';
            $lesson->description = 'Aurora allows Ethereum\'s most popular applications to leverage NEAR\'s powerful blockchain protocol to dramatically increase scalability and efficiency while cutting fees by up to 99.99%.';
            $lesson->thumbnail = 'l2e/image/5-Aurora.png';
            $lesson->content_url = 'l2e/video/test.mov';
            $lesson->content_type = 0;
            $lesson->save();
        }
    }

    private function createQuestionAndAnswerData()
    {
        $lessonDatas = $this->getLessonData();
        foreach($lessonDatas as $lessonId => $questions) {
            // loop question
            foreach($questions as $idx => $questionObj) {
                // Register question
                $questionData = $questionObj['question'];
                $question = new Question();
                $question->lesson_id = $lessonId;
                $questionId = $lessonId . '-question-' . ($idx + 1);
                $question->id = $questionId;
                $question->question_at = $questionData['point'];
                $question->question = $questionData['text'];
                $question->save();

                // Register answer
                $answers = $questionObj['answers'];
                $this->registerLessonAnswer($questionId, $answers);
            }
        }
    }

    private function registerLessonAnswer($questionId, $answers)
    {
        foreach ($answers as $answer => $isCorrect) {
            $lessonAnswer = new LessonAnswer();
            $lessonAnswer->question_id = $questionId;
            $lessonAnswer->answer = $answer;
            $lessonAnswer->correct = $isCorrect;
            $lessonAnswer->save();
        }
    }

    private function getLessonData()
    {
        $data = [
            self::DEFAULT_LESSON_ID1 => [
                [
                    'question' => [
                        'point' => 18, 'text' => 'What technology does NEAR use to increase number of transactions and scalability?',
                    ],
                    'answers' => ['Sharding' => true, 'Side-chain' => false, 'Hub' => false]
                ],
                [
                    'question' => [
                        'point' => 40, 'text' => 'Who is the founder NEAR protocol?',
                    ],
                    'answers' => ['Alexander Skidanov' => false, 'Ilya Polosukhin' => false, 'Both A and B' => true],
                ],
                [
                    'question' => [
                        'point' => 49, 'text' => 'Which consensus mechanism does NEAR implement?',
                    ],
                    'answers' => ['Proof of Stake' => true, 'Proof of Work' => false, 'BFT' => false],
                ],
                [
                    'question' => [
                        'point' => 61, 'text' => 'Which role ensures network security?',
                    ],
                    'answers' => ['Validator' => true, 'Nominator' => false, 'Noone' => false],
                ],
                [
                    'question' => [
                        'point' => 62, 'text' => 'What do validators do in NEAR?',
                    ],
                    'answers' => ['Nothing' => false, 'Staking ' => true, 'Delegating' => false],
                ],
                [
                    'question' => [
                        'point' => 63, 'text' => 'What happens if validators is malacious?',
                    ],
                    'answers' => ['Có phần thưởng' => false, 'Mất hết lượng Staking' => false, 'Sẽ ko dc làm Validators nữa' => false, 'Both' => true],
                ],
                [
                    'question' => [
                        'point' => 67, 'text' => 'Can normal users staking or not?',
                    ],
                    'answers' => ['Có' => false, 'Không' => true, '' => false],
                ],
                [
                    'question' => [
                        'point' => 91, 'text' => 'How developer in Ethereum can develop Dapps in NEAR?',
                    ],
                    'answers' => ['Aurora' => false, 'Rainbow Bridge' => false, 'Both A and B' => true],
                ],
                [
                    'question' => [
                        'point' => 138, 'text' => 'How to register near mainnet wallet?',
                    ],
                    'answers' => ['<tên địa chỉ>.near' => true, '<tên địa chỉ>.testnet' => false, '<tên địa chỉ>.near-testnet' => false],
                ]
            ],
            'basic-near-lesson-2' => [
                ['question' => ['point' => 33, 'text' => 'What is near wallet?'],	'answers' => ['web-based, own your assets, token, nft, ...' => true, 'extension-based, own your assets, token, nft' => false, 'own your assets, token, nft,...' => false]],
                ['question' => ['point' => 33, 'text' => 'What permissions in near wallet do you have?'],	'answers' => ['full control' => true, 'only using token' => false, 'restricted permission' => false]],
                ['question' => ['point' => 63, 'text' => 'How to create near wallet?'],	'answers' => ['wallet.near.org' => true, 'near.wallet.org' => false, 'near.wallet.com' => false]],
                ['question' => ['point' => 87, 'text' => 'Is it possible to staking in NEAR Wallet?'],	'answers' => ['No' => false, 'Yes' => true, 'Not supported yet' => false]],
                ['question' => ['point' => 87, 'text' => 'How to staking in NEAR wallet?'],	'answers' => ['choose a validator -> select amount of NEAR to stake' => false, 'select multiple validators -> select amount of NEAR to stake' => false, 'login near wallet -> select multile validators->select amount of NEAR to stake ' => true]],
                ['question' => ['point' => 104, 'text' => 'When we receive a reward after staking for validators?'],	'answers' => ['12 hours' => true, '1 days' => false, '18 hours' => false]],
            ],
            'basic-near-lesson-3' => [
                ['question' => ['point' => 16, 'text' => 'What problems when the network become more secure?'],	'answers' => ['TPS increase (transaction per second)' => false, 'Lower TPS' => true, 'More Decentralize' => false]],
                ['question' => ['point' => 54, 'text' => 'What is sharding?'],	'answers' => ['divide database into small chunks ' => false, 'A and C' => true, 'multiple nodes can verify multiple blocks' => false]],
                ['question' => ['point' => 54, 'text' => 'What problems will sharding solve in blockchain?'],	'answers' => ['secure,fast, scalable' => false, 'secure, fast, scalable, decentralized' => true, 'fast, scalable, decentralized' => false]],
                ['question' => ['point' => 60, 'text' => 'What is the ideal TPS in NEAR'],	'answers' => ['10,000 TPS' => false, '100,000 TPS' => true, '50,000 TPS' => false]],
                ['question' => ['point' => 94, 'text' => 'What sharding technology near has?'],	'answers' => ['Shard' => false, 'IceShard' => false, 'Nightshard' => true]],
            ],
            'basic-near-lesson-4' => [
                ['question' => ['point' => 40, 'text' => 'Rainbow bridge is a bridge between which 2 platforms?'],	'answers' => ['Near vs ETH' => true, 'Near vs Aurora' => false, 'Both A and B' => false]],
                ['question' => ['point' => 50, 'text' => 'What can\'t rainbow bridge do?'],	'answers' => ['Transfer assets' => false, 'Call PRC ' => false, 'call multi-contract' => true]],
                ['question' => ['point' => 63, 'text' => 'What token standard is supported to exchange between Near <-> ETH'],	'answers' => ['Erc-721' => false, 'Erc-20' => true, 'Both A and B' => false]],
                ['question' => ['point' => 117, 'text' => 'Which of the following protocols does the rainbow bridge use?'],	'answers' => ['Trustless, permission' => false, 'Trust, permissionless' => false, 'Trustless, permissionless' => true]],
                ['question' => ['point' => 109, 'text' => 'How long does it take to transfer tokens from ETH to Near'],	'answers' => ['6 minutes' => false, '7 minutes' => true, '8 minutes' => false]],
            ],
            'basic-near-lesson-5' => [
                ['question' => ['point' => 30, 'text' => 'What problems does Aurora solve on the ETH network?'],	'answers' => ['High speed, low gas fee' => true, 'Use ETH asset with gas fee cheap' => false, 'Both A and B' => false]],
                ['question' => ['point' => 45, 'text' => 'What is Aurora'],	'answers' => ['Bridge with ETH and Near' => false, 'DEX' => false, 'EVM' => true]],
                ['question' => ['point' => 90, 'text' => 'What wallet does Aurora users use ?'],	'answers' => ['Near wallet' => false, 'Metamask wallet' => true, 'Both A and B' => false]],
            ],
        ];

        if(env('APP_ENV') === 'local') {
            $data['basic-near-lesson-test'] = [
                [
                    'question' => [
                        'point' => 1, 'text' => 'How developer in Ethereum can develop Dapps in NEAR?',
                    ],
                    'answers' => ['Aurora' => false, 'Rainbow Bridge' => false, 'Both A and B' => true],
                ],
                [
                    'question' => [
                        'point' => 2, 'text' => 'How to register near mainnet wallet?',
                    ],
                    'answers' => ['<tên địa chỉ>.near' => true, '<tên địa chỉ>.testnet' => false, '<tên địa chỉ>.near-testnet' => false],
                ],
                [
                    'question' => [
                        'point' => 3, 'text' => 'How to register near mainnet wallet?',
                    ],
                    'answers' => ['<tên địa chỉ>.near' => true, '<tên địa chỉ>.testnet' => false, '<tên địa chỉ>.near-testnet' => false],
                ],
                [
                    'question' => [
                        'point' => 4, 'text' => 'How to register near mainnet wallet?',
                    ],
                    'answers' => ['<tên địa chỉ>.near' => true, '<tên địa chỉ>.testnet' => false, '<tên địa chỉ>.near-testnet' => false],
                ]
            ];
        }

        return $data;
    }

    private function createCampaignData()
    {
        $campaign = new Campaign();
        $campaign->id = 'campaign-7688-6146-9854-20c9d07b7361';
        $campaign->content_id = self::DEFAULT_COURSE_ID1;
        $campaign->content_type = CAMPAIGN_LEARN;
        $campaign->total_budget = 100;
        $campaign->creator_budget = 1;
        $campaign->referral_budget = 1;
        $campaign->user_budget = 2;
        $campaign->start_at = '2022/01/01';
        $campaign->end_at = '2022/12/01';
        $campaign->save();
    }

    private function createOrderData()
    {
        $clientId = User::where('email', 'client@plats.network')->pluck('id')->first();
        $gameTemplateId = GameTemplate::pluck('id')->first();

        $order = new Order();
        $order->client_id = $clientId;
        $order->game_template_id = $gameTemplateId;
        $order->game_id = self::DEFAULT_LESSON_ID1;
        $order->content = 'Please change banner image by our banner';
        $order->agreement_amount = 20;
        $order->royalty_fee = 0.05;
        $order->status = ACCEPTED_ORDER_STATUS;
        $order->save();
    }
}
