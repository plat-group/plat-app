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
    const DEFAULT_COURSE_ID2 = 'rainbow-bridge-course-1';
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
        // $this->createLessonData();
        // $this->createQuestionAndAnswerData();

        $this->createCampaignData();
    }

    private function createCourseData()
    {
        $clientId = User::where('email', 'client@plats.network')->pluck('id')->first();

        $data = $this->createData($clientId);

        foreach($data as $course) {
            // Save course
            $this->saveCourse($course);

            // Save lessons
            $courseId = $course['id'];
            $idx = 1;
            foreach($course['lessons'] as $lesson) {

                $lessonId = $course['lesson_id_prefix'] . $idx;

                $this->saveLesson($courseId, $lessonId, $lesson);

                $jdx = 1;
                foreach($lesson['questions'] as $questionObj) {
                    // Save Question
                    $questionData = $questionObj['question'];
                    $questionId = $lessonId . '-question-' . $jdx;

                    $this->saveQuestion($lessonId, $questionId, $questionData);

                    // Save Anwser
                    $answers = $questionObj['answers'];
                    foreach($answers as $answerText => $isCorrect) {
                        $this->saveAnswer($questionId, $answerText, $isCorrect);
                    }
                    $jdx++;
                }
                $idx++;
            }
        }
    }


    private function saveCourse($courseData) {
        $course = new Course();

        $course->id = $courseData['id'];
        $course->creator_id = $courseData['creator_id'];
        $course->name = $courseData['name'];
        $course->description = $courseData['description'];
        $course->thumbnail = $courseData['thumbnail'];
        $course->status = $courseData['status'];
        $course->save();
    }

    private function saveLesson($courseId, $lessonId, $lessonData) {
        $lesson = new Lesson();
        $lesson->course_id = $courseId;
        $lesson->id = $lessonId;
        $lesson->name = $lessonData['name'];
        $lesson->description = $lessonData['description'];
        $lesson->thumbnail = $lessonData['thumbnail'];
        $lesson->content_url = $lessonData['content_url'];
        $lesson->content_type = $lessonData['content_type'];
        $lesson->save();
    }

    private function saveQuestion($lessonId, $questionId, $questionData)
    {
        // Register question
        $question = new Question();
        $question->lesson_id = $lessonId;
        $question->id = $questionId;
        $question->question_at = $questionData['point'];
        $question->question = $questionData['text'];
        $question->save();
    }

    private function saveAnswer($questionId, $answerText, $isCorrect)
    {
        $lessonAnswer = new LessonAnswer();
        $lessonAnswer->question_id = $questionId;
        $lessonAnswer->answer = $answerText;
        $lessonAnswer->correct = $isCorrect;
        $lessonAnswer->save();
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

    private function createData($creatorId) {
        return [
            // course 1
            [
                'id' => self::DEFAULT_COURSE_ID1,
                'creator_id' => $creatorId,
                'name' => 'Basic NEAR Protocol learning course',
                'description' => 'Reimagine finance, creativity, and community with NEAR',
                'thumbnail' => 'l2e/image/basic_near_course.png',
                'status' => ON_POOL_STATUS,
                'lesson_id_prefix' => 'basic-near-lesson-',
                'lessons' => [
                    [
                        'name' => 'What is NEAR?',
                        'description' => 'NEAR is a layer-1 blockchain that is simple to use, super fast, and incredibly secure. NEAR has been awarded the Climate Neutral Product Label from the South Pole and is actively helping users and developers reimagine finance, community, and creativity. Get to grips with what NEAR is, how it works, and discover why it’s so powerful for developers and users.',
                        'thumbnail' => 'l2e/image/1-What-is-NEAR.png',
                        'content_url' => 'l2e/video/what-is-near.mp4',
                        'content_type' => 0,
                        'questions' => [
                            ['question' => ['point' => 22, 'text' => 'What technology does NEAR use to increase number of transactions and scalability?'],	'answers' => ['Sharding' => true, 'Side-chain' => false, 'Hub' => false]],
                            ['question' => ['point' => 34, 'text' => 'Who is the founder NEAR protocol?'],	'answers' => ['Alexander Skidanov' => false, 'Ilya Polosukhin' => false, 'Both A and B' => true]],
                            ['question' => ['point' => 47, 'text' => 'Which consensus mechanism does NEAR implement?'],	'answers' => ['Proof of Stake' => true, 'Proof of Work' => false, 'BFT' => false]],
                            ['question' => ['point' => 61, 'text' => 'Which role ensures network security?'],	'answers' => ['Validator' => true, 'Nominator' => false, 'None' => false]],
                            ['question' => ['point' => 62, 'text' => 'What do validators do in NEAR?'],	'answers' => ['Nothing' => false, 'Staking ' => true, 'Delegating' => false]],
                            ['question' => ['point' => 63, 'text' => 'What happens if validators is malacious?'],	'answers' => ['Lose all reward' => false, 'Lose all staking amount' => false, 'Lose role validators' => false ,'All of them' => true]],
                            ['question' => ['point' => 71, 'text' => 'Can normal users staking or not?'],	'answers' => ['Yes' => false, 'No' => true]],
                            ['question' => ['point' => 101, 'text' => 'How developer in Ethereum can develop Dapps in NEAR?'],	'answers' => ['Aurora' => false, 'Rainbow Bridge' => false, 'Both A and B' => true]],
                            ['question' => ['point' => 140, 'text' => 'How to register near mainnet wallet?'],	'answers' => ['{address_name}.near' => true, '{address_name}.testnet' => false, '{address_name}.near-protocol' => false]],
                        ],
                    ],
                    [
                        'name' => 'NEAR Wallet & Staking',
                        'description' => 'NEAR wallet is a non-custodial, web-based application, that gives you full control over your assets — allowing you to create, play, and stake without restrictions. Sign-up takes just a few clicks, and once complete the world of staking rewards, NFTs, and more will be accessible and easy to use.',
                        'thumbnail' => 'l2e/image/2-Wallet.png',
                        'content_url' => 'l2e/video/NEAR-Wallet-Staking.mp4',
                        'content_type' => 0,
                        'questions' => [
                            ['question' => ['point' => 33, 'text' => 'What is near wallet?'],	'answers' => ['web-based, own your assets, token, nft, ...' => true, 'extension-based, own your assets, token, nft' => false, 'own your assets, token, nft,...' => false]],
                            ['question' => ['point' => 33, 'text' => 'What permissions in near wallet do you have?'],	'answers' => ['full control' => true, 'only using token' => false, 'restricted permission' => false]],
                            ['question' => ['point' => 63, 'text' => 'How to create near wallet?'],	'answers' => ['wallet.near.org' => true, 'near.wallet.org' => false, 'near.wallet.com' => false]],
                            ['question' => ['point' => 87, 'text' => 'Is it possible to staking in NEAR Wallet?'],	'answers' => ['No' => false, 'Yes' => true, 'Not supported yet' => false]],
                            ['question' => ['point' => 87, 'text' => 'How to staking in NEAR wallet?'],	'answers' => ['choose a validator -> select amount of NEAR to stake' => false, 'select multiple validators -> select amount of NEAR to stake' => false, 'login near wallet -> select multile validators->select amount of NEAR to stake ' => true]],
                            ['question' => ['point' => 104, 'text' => 'When we receive a reward after staking for validators?'],	'answers' => ['12 hours' => true, '1 days' => false, '18 hours' => false]],
                        ]
                    ],
                    [
                        'name' => 'NEAR Sharding in a Nutshell',
                        'description' => "NEAR’s blockchain uses a revolutionary new type of sharding tool called Nightshade to help create infinite scalability and speed. In this lesson, we explore how it works and why it makes sure the NEAR network is primed for mass adoption.",
                        'thumbnail' => 'l2e/image/3-Sharding.png',
                        'content_url' => 'l2e/video/NEAR-Sharding-in-a Nutshell.mp4',
                        'content_type' => 0,
                        'questions' => [
                            ['question' => ['point' => 16, 'text' => 'What problems when the network become more secure?'],	'answers' => ['TPS increase (transaction per second)' => false, 'Lower TPS' => true, 'More Decentralize' => false]],
                            ['question' => ['point' => 54, 'text' => 'What is sharding?'],	'answers' => ['divide database into small chunks ' => false, 'A and C' => true, 'multiple nodes can verify multiple blocks' => false]],
                            ['question' => ['point' => 54, 'text' => 'What problems will sharding solve in blockchain?'],	'answers' => ['secure,fast, scalable' => false, 'secure, fast, scalable, decentralized' => true, 'fast, scalable, decentralized' => false]],
                            ['question' => ['point' => 60, 'text' => 'What is the ideal TPS in NEAR'],	'answers' => ['10,000 TPS' => false, '100,000 TPS' => true, '50,000 TPS' => false]],
                            ['question' => ['point' => 94, 'text' => 'What sharding technology near has?'],	'answers' => ['Shard' => false, 'IceShard' => false, 'Nightshard' => true]],
                        ]
                    ],
                    [
                        'name' => 'The Rainbow Bridge',
                        'description' => 'Rainbow Bridge is a gateway to other blockchains. The Bridge allows users to seamlessly connect NEAR with other blockchains allowing the movement of tokens into new ecosystems with little more than a few clicks. As a trustless, permissionless tool for cross-chain transfers, it’s the easiest, and simplest way to move assets between NEAR and Ethereum.',
                        'thumbnail' => 'l2e/image/4-Rainbow-Bridge.png',
                        'content_url' => 'l2e/video/The-Rainbow-Bridge.mp4',
                        'content_type' => 0,
                        'questions' => [
                            ['question' => ['point' => 40, 'text' => 'Rainbow bridge is a bridge between which 2 platforms?'],	'answers' => ['Near vs ETH' => true, 'Near vs Aurora' => false, 'Both A and B' => false]],
                            ['question' => ['point' => 50, 'text' => 'What can\'t rainbow bridge do?'],	'answers' => ['Transfer assets' => false, 'Call PRC ' => false, 'call multi-contract' => true]],
                            ['question' => ['point' => 63, 'text' => 'What token standard is supported to exchange between Near <-> ETH'],	'answers' => ['Erc-721' => false, 'Erc-20' => true, 'Both A and B' => false]],
                            ['question' => ['point' => 117, 'text' => 'Which of the following protocols does the rainbow bridge use?'],	'answers' => ['Trustless, permission' => false, 'Trust, permissionless' => false, 'Trustless, permissionless' => true]],
                            ['question' => ['point' => 109, 'text' => 'How long does it take to transfer tokens from ETH to Near'],	'answers' => ['6 minutes' => false, '7 minutes' => true, '8 minutes' => false]],
                        ]
                    ],
                    [
                        'name' => 'What is Aurora?',
                        'description' => 'Aurora allows Ethereum\'s most popular applications to leverage NEAR\'s powerful blockchain protocol to dramatically increase scalability and efficiency while cutting fees by up to 99.99%.',
                        'thumbnail' => 'l2e/image/5-Aurora.png',
                        'content_url' => 'l2e/video/What-is-Aurora.mp4',
                        'content_type' => 0,
                        'questions' => [
                            ['question' => ['point' => 30, 'text' => 'What problems does Aurora solve on the ETH network?'],	'answers' => ['High speed, low gas fee' => true, 'Use ETH asset with gas fee cheap' => false, 'Both A and B' => false]],
                            ['question' => ['point' => 45, 'text' => 'What is Aurora'],	'answers' => ['Bridge with ETH and Near' => false, 'DEX' => false, 'EVM' => true]],
                            ['question' => ['point' => 90, 'text' => 'What wallet does Aurora users use ?'],	'answers' => ['Near wallet' => false, 'Metamask wallet' => true, 'Both A and B' => false]],
                        ]
                    ]
                ],
            ],
            // course2
            [
                'id' => self::DEFAULT_COURSE_ID2,
                'creator_id' => $creatorId,
                'name' => 'The Rainbow Bridge',
                'description' => 'A gateway to other blockchains',
                'thumbnail' => 'l2e/image/4-Rainbow-Bridge.png',
                'status' => ON_POOL_STATUS,
                'lesson_id_prefix' => 'rainbow-bridge-lesson-',
                'lessons' => [
                    [
                        'name' => 'The Rainbow Bridge',
                        'description' => 'Rainbow Bridge is a gateway to other blockchains. The Bridge allows users to seamlessly connect NEAR with other blockchains allowing the movement of tokens into new ecosystems with little more than a few clicks. As a trustless, permissionless tool for cross-chain transfers, it’s the easiest, and simplest way to move assets between NEAR and Ethereum.',
                        'thumbnail' => 'l2e/image/4-Rainbow-Bridge.png',
                        'content_url' => 'l2e/video/The-Rainbow-Bridge.mp4',
                        'content_type' => 0,
                        'questions' => [
                            ['question' => ['point' => 40, 'text' => 'Rainbow bridge is a bridge between which 2 platforms?'],	'answers' => ['Near vs ETH' => true, 'Near vs Aurora' => false, 'Both A and B' => false]],
                            ['question' => ['point' => 50, 'text' => 'What can\'t rainbow bridge do?'],	'answers' => ['Transfer assets' => false, 'Call PRC ' => false, 'call multi-contract' => true]],
                            ['question' => ['point' => 63, 'text' => 'What token standard is supported to exchange between Near <-> ETH'],	'answers' => ['Erc-721' => false, 'Erc-20' => true, 'Both A and B' => false]],
                            ['question' => ['point' => 117, 'text' => 'Which of the following protocols does the rainbow bridge use?'],	'answers' => ['Trustless, permission' => false, 'Trust, permissionless' => false, 'Trustless, permissionless' => true]],
                            ['question' => ['point' => 109, 'text' => 'How long does it take to transfer tokens from ETH to Near'],	'answers' => ['6 minutes' => false, '7 minutes' => true, '8 minutes' => false]],
                        ]
                    ]
                ]
            ]
        ];
    }
}
