<?php
// ============================================
// آزمون فارسی پنجم ابتدایی - درس یک
// آموزگار: خانم اسعدی
// ============================================

session_start();

// پاسخ‌های صحیح سوالات چندگزینه‌ای
$correctAnswers = [
    'q1' => '2',
    'q2' => '1',
    'q3' => '2',
    'q4' => '2',
    'q5' => '2'
];

// آرایه سوالات
$questions = [
    'q1' => [
        'text' => 'بر اساس متن درس، برای شناخت بهتر عالم چه راهی پیشنهاد شده است؟',
        'options' => [
            '1' => 'فقط تماشای کوه‌ها و درّه‌ها',
            '2' => 'تماشا کردن پدیده‌ها، اندیشیدن درباره‌ی آفرینش آنها و مقایسه با یکدیگر',
            '3' => 'سفر کردن به مناطق مختلف',
            '4' => 'فقط مطالعه کتاب‌های علمی'
        ]
    ],
    'q2' => [
        'text' => 'نویسنده، جهان را چه چیزی معرفی می‌کند؟',
        'options' => [
            '1' => 'تماشاخانه‌ی شگفتی‌های آفرینش',
            '2' => 'دفتری پر از نوشته‌های انسان‌ها',
            '3' => 'جنگلی تاریک و پر از رمز و راز',
            '4' => 'موزه‌ای از صنایع دستی'
        ]
    ],
    'q3' => [
        'text' => 'در متن درس، کدام مورد به عنوان یکی از شگفتی‌ها و بهترین موضوع برای فکر کردن معرفی شده است؟',
        'options' => [
            '1' => 'کوه‌های سر به فلک کشیده',
            '2' => 'آب گوارا',
            '3' => 'پروانه‌های مخملی',
            '4' => 'عنکبوت‌ها'
        ]
    ],
    'q4' => [
        'text' => 'نویسنده درباره‌ی علف‌های سبز چه می‌گوید؟',
        'options' => [
            '1' => 'همیشه سبز و محکم هستند',
            '2' => 'نرم و شکننده هستند ولی گاهی از میان سنگلاخ سر در می‌آورند',
            '3' => 'در گرما و سرما همیشه زنده می‌مانند',
            '4' => 'فقط در بهار رشد می‌کنند'
        ]
    ],
    'q5' => [
        'text' => 'چه کسانی از هر چیز پرسش می‌کنند و برای یافتن پاسخ جست‌وجو می‌کنند؟',
        'options' => [
            '1' => 'فقط معلمان',
            '2' => 'دانشمندان و عالمان',
            '3' => 'فقط نویسندگان',
            '4' => 'همه مردم عادی'
        ]
    ]
];

// پردازش فرم
$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentName = trim($_POST['studentName'] ?? '');
    $answers = [];
    foreach ($correctAnswers as $key => $correct) {
        $answers[$key] = $_POST[$key] ?? '';
    }
    $q6 = trim($_POST['q6'] ?? '');
    $q7 = trim($_POST['q7'] ?? '');

    if ($studentName === '') {
        $result = ['error' => 'لطفاً نام خود را وارد کنید.'];
    } else {
        $score = 0;
        $totalMCQ = count($correctAnswers);
        $totalDescriptive = 2;
        $totalQuestions = $totalMCQ + $totalDescriptive;
        $pointsPerQuestion = 100 / $totalQuestions;

        // بررسی سوالات چندگزینه‌ای
        foreach ($correctAnswers as $key => $correct) {
            if ($answers[$key] === $correct) {
                $score += $pointsPerQuestion;
            }
        }
        // بررسی سوالات تشریحی
        if ($q6 !== '') $score += $pointsPerQuestion;
        if ($q7 !== '') $score += $pointsPerQuestion;

        $finalScore = round($score);
        $isProud = $finalScore >= 75;

        $result = [
            'name' => $studentName,
            'score' => $finalScore,
            'isProud' => $isProud,
            'message' => $isProud
                ? htmlspecialchars($studentName) . ' جان، خانم اسعدی بهت افتخار می‌کنه!'
                : ''
        ];

        // ذخیره در فایل (اختیاری)
        $logLine = date('Y-m-d H:i:s') . " | " . $studentName . " | نمره: " . $finalScore . PHP_EOL;
        @file_put_contents(__DIR__ . '/results.txt', $logLine, FILE_APPEND);
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>آزمون فارسی پنجم ابتدایی - درس یک - خانم اسعدی</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background: linear-gradient(135deg, #fce4ec 0%, #f3e5f5 50%, #e8eaf6 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px 15px;
        }

        .container {
            max-width: 850px;
            width: 100%;
            background: #ffffff;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(180, 130, 180, 0.25), 0 8px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        /* هدر */
        .header {
            background: linear-gradient(135deg, #f8bbd0 0%, #e1bee7 50%, #d1c4e9 100%);
            padding: 35px 30px 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .header::before { content: '🌸'; position: absolute; top: 10px; right: 20px; font-size: 40px; opacity: 0.4; transform: rotate(15deg); }
        .header::after { content: '🌿'; position: absolute; bottom: 5px; left: 25px; font-size: 35px; opacity: 0.35; transform: rotate(-10deg); }
        .header h1 { font-size: 1.9rem; color: #4a148c; font-weight: 700; margin-bottom: 6px; position: relative; z-index: 1; }
        .header h2 { font-size: 1.15rem; color: #6a1b9a; font-weight: 400; position: relative; z-index: 1; }

        .teacher-name {
            display: inline-block;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(4px);
            color: #6a1b9a;
            padding: 6px 24px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            margin-top: 12px;
            position: relative;
            z-index: 1;
            border: 1.5px solid rgba(206, 147, 216, 0.5);
        }
        .teacher-name .icon { margin-left: 6px; }

        .header .decor-line {
            width: 80px; height: 4px;
            background: linear-gradient(90deg, #ce93d8, #f48fb1, #ce93d8);
            border-radius: 10px; margin: 12px auto 0;
            position: relative; z-index: 1;
        }

        /* بخش نام دانش‌آموز */
        .name-section {
            margin: 25px 30px 10px;
            background: linear-gradient(135deg, #fdf2f8, #f3e5f5);
            border-radius: 20px;
            padding: 22px 25px;
            border: 2px solid #f8bbd0;
            text-align: center;
        }
        .name-section .name-label {
            font-size: 1.05rem; font-weight: 700; color: #6a1b9a;
            margin-bottom: 14px; display: flex; align-items: center;
            justify-content: center; gap: 8px;
        }
        .name-section input[type="text"] {
            width: 100%; max-width: 400px;
            padding: 14px 20px;
            border: 2px solid #ce93d8;
            border-radius: 50px;
            font-family: 'Vazirmatn', sans-serif;
            font-size: 1rem; color: #4a148c; text-align: center;
            outline: none; transition: all 0.3s ease;
            background: #fff; direction: rtl;
        }
        .name-section input[type="text"]:focus {
            border-color: #8e24aa;
            box-shadow: 0 0 0 4px rgba(206, 147, 216, 0.25);
        }

        /* بخش سوالات */
        .quiz-section { padding: 20px 30px 35px; }
        .quiz-section .section-title {
            display: flex; align-items: center; gap: 10px;
            font-size: 1.2rem; font-weight: 700; color: #6a1b9a;
            margin-bottom: 20px;
        }

        .question-card {
            background: #faf5ff;
            border-radius: 18px;
            padding: 20px 22px;
            margin-bottom: 18px;
            border: 1.5px solid #ede7f6;
            transition: all 0.3s ease;
        }
        .question-card:hover {
            border-color: #ce93d8;
            box-shadow: 0 6px 20px rgba(206, 147, 216, 0.2);
            transform: translateY(-2px);
        }

        .q-number {
            display: inline-flex; align-items: center; justify-content: center;
            width: 32px; height: 32px;
            background: linear-gradient(135deg, #ce93d8, #ba68c8);
            color: #fff; border-radius: 50%; font-size: 0.9rem;
            font-weight: 700; margin-left: 8px; flex-shrink: 0;
        }
        .q-text {
            font-size: 1rem; font-weight: 600; color: #4a148c;
            line-height: 1.8; display: flex; align-items: flex-start;
            gap: 8px; margin-bottom: 14px;
        }

        /* دکمه پخش صدا سوال */
        .speak-btn {
            background: linear-gradient(135deg, #f48fb1, #ce93d8);
            color: #fff;
            border: none;
            width: 36px; height: 36px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.25s ease;
            box-shadow: 0 4px 10px rgba(244, 143, 177, 0.4);
        }
        .speak-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(244, 143, 177, 0.6);
        }
        .speak-btn:active { transform: scale(0.95); }
        .speak-btn.speaking {
            background: linear-gradient(135deg, #ba68c8, #8e24aa);
            animation: pulse 1s infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(206, 147, 216, 0.6); }
            50% { box-shadow: 0 0 0 10px rgba(206, 147, 216, 0); }
        }

        /* گزینه‌ها */
        .options { display: flex; flex-direction: column; gap: 8px; padding-right: 40px; }
        .option {
            display: flex; align-items: center; gap: 10px;
            background: #fff; padding: 10px 16px;
            border-radius: 12px; border: 1.5px solid #ede7f6;
            cursor: pointer; transition: all 0.25s ease;
            font-size: 0.92rem; color: #4a148c;
        }
        .option:hover {
            border-color: #ce93d8;
            background: #fdf2f8;
            transform: translateX(-4px);
        }
        .option input[type="radio"] {
            appearance: none; -webkit-appearance: none;
            width: 20px; height: 20px;
            border: 2px solid #ce93d8;
            border-radius: 50%; outline: none;
            cursor: pointer; flex-shrink: 0;
            transition: all 0.2s ease;
        }
        .option input[type="radio"]:checked {
            border-color: #8e24aa;
            background: #8e24aa;
            box-shadow: inset 0 0 0 3px #fff;
        }

        /* سوالات تشریحی */
        .short-answer { padding-right: 40px; }
        .short-answer textarea {
            width: 100%; min-height: 70px;
            border: 1.5px solid #ede7f6;
            border-radius: 12px;
            padding: 12px 16px;
            font-family: 'Vazirmatn', sans-serif;
            font-size: 0.92rem; color: #4a148c;
            resize: vertical; outline: none;
            background: #fff; direction: rtl;
            transition: border-color 0.3s;
        }
        .short-answer textarea:focus {
            border-color: #ce93d8;
            box-shadow: 0 0 0 3px rgba(206, 147, 216, 0.15);
        }

        /* دکمه‌ها */
        .btn-group {
            display: flex; gap: 15px;
            justify-content: center; margin-top: 30px; flex-wrap: wrap;
        }
        .btn {
            padding: 14px 40px;
            border: none; border-radius: 50px;
            font-family: 'Vazirmatn', sans-serif;
            font-size: 1rem; font-weight: 700;
            cursor: pointer; transition: all 0.3s ease;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-submit {
            background: linear-gradient(135deg, #ab47bc, #8e24aa);
            color: #fff;
            box-shadow: 0 8px 25px rgba(142, 36, 170, 0.35);
        }
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(142, 36, 170, 0.45);
        }
        .btn-reset {
            background: #f3e5f5;
            color: #6a1b9a;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }
        .btn-reset:hover { background: #ede7f6; transform: translateY(-3px); }

        /* نتیجه */
        .result-box {
            margin-top: 25px;
            background: linear-gradient(135deg, #f3e5f5, #fce4ec);
            border-radius: 20px;
            padding: 25px 30px;
            text-align: center;
            border: 2px solid #ce93d8;
            animation: fadeIn 0.6s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .result-box .score { font-size: 2.2rem; font-weight: 800; color: #6a1b9a; }
        .result-box .message { font-size: 1rem; color: #4a148c; margin-top: 8px; line-height: 1.8; }
        .result-box .emoji { font-size: 2.5rem; display: block; margin-bottom: 5px; }

        .proud-message {
            margin-top: 18px;
            padding: 18px 22px;
            background: linear-gradient(135deg, #fff3e0, #fce4ec, #f3e5f5);
            border-radius: 18px;
            border: 2px dashed #f48fb1;
            font-size: 1.1rem; font-weight: 700;
            color: #ad1457; line-height: 1.9;
            animation: pulseGlow 2s ease-in-out infinite;
        }
        .proud-message .heart { font-size: 1.4rem; margin: 0 4px; }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(244, 143, 177, 0.4); }
            50% { box-shadow: 0 0 25px 6px rgba(244, 143, 177, 0.25); }
        }

        /* هشدار خطا */
        .error-box {
            margin: 20px 30px 0;
            padding: 15px 20px;
            background: #ffebee;
            border-right: 5px solid #e57373;
            border-radius: 12px;
            color: #c62828;
            font-weight: 600;
            text-align: center;
        }

        /* فوتر */
        .footer {
            text-align: center; padding: 18px;
            background: linear-gradient(135deg, #fdf2f8, #f3e5f5);
            color: #8e24aa; font-size: 0.8rem;
            border-top: 1px solid #ede7f6;
        }
        .footer span { font-weight: 600; }

        @media (max-width: 600px) {
            .header h1 { font-size: 1.4rem; }
            .header h2 { font-size: 1rem; }
            .name-section { margin: 15px 15px 5px; padding: 18px; }
            .quiz-section { padding: 15px 15px 25px; }
            .question-card { padding: 15px; }
            .options { padding-right: 20px; }
            .short-answer { padding-right: 20px; }
            .btn { padding: 12px 28px; font-size: 0.9rem; }
            .btn-group { flex-direction: column; align-items: center; }
            .result-box .score { font-size: 1.8rem; }
            .proud-message { font-size: 0.95rem; }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- هدر -->
    <div class="header">
        <h1>🌸 آزمون فارسی 🌸</h1>
        <h2>پایه پنجم ابتدایی — درس یک</h2>
        <div class="teacher-name">
            <span class="icon">👩‍🏫</span>
            آموزگار: خانم اسعدی
        </div>
        <div class="decor-line"></div>
    </div>

    <?php if ($result && isset($result['error'])): ?>
        <div class="error-box">⚠️ <?= htmlspecialchars($result['error']) ?></div>
    <?php endif; ?>

    <form method="POST" action="" id="quizForm">
        <!-- نام دانش‌آموز -->
        <div class="name-section">
            <div class="name-label">
                <span class="icon">✍️</span>
                <span>دانش‌آموز عزیز، لطفاً نام خود را بنویس:</span>
                <button type="button" class="speak-btn" onclick="speakText('دانش آموز عزیز، لطفاً نام خود را بنویس')" title="پخش صدا">🔊</button>
            </div>
            <input type="text" name="studentName" id="studentName" placeholder="نام و نام خانوادگی..." autocomplete="off"
                   value="<?= htmlspecialchars($_POST['studentName'] ?? '') ?>">
        </div>

        <!-- سوالات -->
        <div class="quiz-section">
            <div class="section-title">
                <span class="icon">✏️</span>
                <span>به سوالات زیر پاسخ بده</span>
                <button type="button" class="speak-btn" onclick="speakText('به سوالات زیر پاسخ بده')" title="پخش صدا">🔊</button>
            </div>

            <?php $qNum = 1; foreach ($questions as $key => $q): ?>
                <div class="question-card">
                    <div class="q-text">
                        <span class="q-number"><?= $qNum ?></span>
                        <span style="flex:1"><?= htmlspecialchars($q['text']) ?></span>
                        <button type="button" class="speak-btn" onclick="speakText('<?= htmlspecialchars($q['text'], ENT_QUOTES) ?>')" title="خواندن سوال">🔊</button>
                    </div>
                    <div class="options">
                        <?php foreach ($q['options'] as $val => $optText): ?>
                            <label class="option">
                                <input type="radio" name="<?= $key ?>" value="<?= $val ?>"
                                    <?= (isset($_POST[$key]) && $_POST[$key] === $val) ? 'checked' : '' ?>>
                                <span><?= htmlspecialchars($optText) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php $qNum++; endforeach; ?>

            <!-- سوال ۶ -->
            <div class="question-card">
                <div class="q-text">
                    <span class="q-number">۶</span>
                    <span style="flex:1">چرا نویسنده می‌گوید: «آفریده‌های ساکت خدا همیشه آنجا هستند»؟ تو چه فکری می‌کنی؟ (در چند جمله بنویس)</span>
                    <button type="button" class="speak-btn" onclick="speakText('چرا نویسنده می‌گوید آفریده های ساکت خدا همیشه آنجا هستند؟ تو چه فکری می کنی؟')" title="خواندن سوال">🔊</button>
                </div>
                <div class="short-answer">
                    <textarea name="q6" placeholder="پاسخ خود را اینجا بنویسید..."><?= htmlspecialchars($_POST['q6'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- سوال ۷ -->
            <div class="question-card">
                <div class="q-text">
                    <span class="q-number">۷</span>
                    <span style="flex:1">از متن درس، دو نمونه از پدیده‌هایی که نویسنده با یکدیگر مقایسه کرده است، بنویس.</span>
                    <button type="button" class="speak-btn" onclick="speakText('از متن درس، دو نمونه از پدیده هایی که نویسنده با یکدیگر مقایسه کرده است، بنویس')" title="خواندن سوال">🔊</button>
                </div>
                <div class="short-answer">
                    <textarea name="q7" style="min-height:50px;" placeholder="مثال: گل با خار، بهار با زمستان..."><?= htmlspecialchars($_POST['q7'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- دکمه‌ها -->
            <div class="btn-group">
                <button type="submit" class="btn btn-submit" onclick="playClickSound()">
                    <span>📝</span> مشاهده نتیجه
                </button>
                <button type="button" class="btn btn-reset" onclick="resetQuiz()">
                    <span>🔄</span> شروع دوباره
                </button>
            </div>
        </div>
    </form>

    <!-- نتیجه -->
    <?php if ($result && !isset($result['error'])): ?>
        <div class="quiz-section" style="padding-top:0;">
            <div class="result-box">
                <?php if ($result['score'] >= 90): ?>
                    <span class="emoji">🏆</span>
                <?php elseif ($result['score'] >= 75): ?>
                    <span class="emoji">🌟</span>
                <?php elseif ($result['score'] >= 50): ?>
                    <span class="emoji">📚</span>
                <?php else: ?>
                    <span class="emoji">💪</span>
                <?php endif; ?>

                <div class="score"><?= htmlspecialchars($result['name']) ?> جان، نمره شما: <?= $result['score'] ?> از ۱۰۰</div>

                <div class="message">
                    <?php
                    if ($result['score'] >= 90) echo 'عالی! تو یک ستاره‌ی درخشان هستی! ✨';
                    elseif ($result['score'] >= 75) echo 'خیلی خوب! با کمی تلاش بیشتر عالی می‌شوی! 💪';
                    elseif ($result['score'] >= 50) echo 'خوب است، اما می‌توانی بهتر باشی! دوباره تلاش کن! 🌱';
                    else echo 'نگران نباش! با مطالعه‌ی بیشتر می‌توانی موفق شوی! 🌸';
                    ?>
                </div>

                <?php if ($result['isProud']): ?>
                    <div class="proud-message">
                        <span class="heart">💖</span>
                        <?= htmlspecialchars($result['name']) ?> جان، خانم اسعدی بهت افتخار می‌کنه!
                        <span class="heart">💖</span>
                        <br>
                        <button type="button" class="speak-btn" style="margin-top:10px;"
                                onclick="speakText('<?= htmlspecialchars($result['name'], ENT_QUOTES) ?> جان، خانم اسعدی بهت افتخار می‌کنه')">
                            🔊
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- فوتر -->
    <div class="footer">
        <span>🌸 با آرزوی موفقیت برای دختران گل — آموزگار: خانم اسعدی 🌸</span>
    </div>
</div>

<script>
// ==========================================
// صدای کلیک با Web Audio API
// ==========================================
let audioCtx = null;

function getAudioContext() {
    if (!audioCtx) {
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    }
    return audioCtx;
}

function playClickSound() {
    try {
        const ctx = getAudioContext();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.connect(gain);
        gain.connect(ctx.destination);
        osc.type = 'sine';
        osc.frequency.setValueAtTime(880, ctx.currentTime);
        osc.frequency.exponentialRampToValueAtTime(440, ctx.currentTime + 0.1);
        gain.gain.setValueAtTime(0.15, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.15);
        osc.start(ctx.currentTime);
        osc.stop(ctx.currentTime + 0.15);
    } catch (e) { console.warn('صدا پخش نشد:', e); }
}

function playSuccessSound() {
    try {
        const ctx = getAudioContext();
        [523.25, 659.25, 783.99].forEach((freq, i) => {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.type = 'sine';
            osc.frequency.value = freq;
            const startTime = ctx.currentTime + i * 0.12;
            gain.gain.setValueAtTime(0.12, startTime);
            gain.gain.exponentialRampToValueAtTime(0.001, startTime + 0.3);
            osc.start(startTime);
            osc.stop(startTime + 0.3);
        });
    } catch (e) { console.warn('صدا پخش نشد:', e); }
}

// اتصال صدای کلیک به همه دکمه‌های رادیویی و دکمه‌ها
document.addEventListener('DOMContentLoaded', function () {
    // صدای کلیک برای رادیوها
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', playClickSound);
    });

    // صدای کلیک برای دکمه‌ها (به‌جز دکمه صدا)
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', playClickSound);
    });

    // افکت صوتی موفقیت بعد از ارسال موفق فرم
    <?php if ($result && !isset($result['error']) && $result['score'] >= 75): ?>
        setTimeout(playSuccessSound, 400);
    <?php endif; ?>

    // فعال‌سازی AudioContext با اولین تعامل کاربر
    document.body.addEventListener('click', function initAudio() {
        getAudioContext();
        document.body.removeEventListener('click', initAudio);
    }, { once: true });
});

// ==========================================
// خواندن متن با Speech Synthesis (فارسی)
// ==========================================
let currentUtterance = null;

function speakText(text) {
    if (!('speechSynthesis' in window)) {
        alert('مرورگر شما از قابلیت خواندن متن پشتیبانی نمی‌کند.');
        return;
    }

    // اگر در حال خواندن است، متوقف کن
    window.speechSynthesis.cancel();

    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'fa-IR';
    utterance.rate = 0.9;
    utterance.pitch = 1.1;

    // پیدا کردن صدای فارسی
    const voices = window.speechSynthesis.getVoices();
    const faVoice = voices.find(v => v.lang && v.lang.startsWith('fa'));
    if (faVoice) utterance.voice = faVoice;

    // افکت روی دکمه در حال پخش
    const btn = event ? event.target.closest('.speak-btn') : null;
    if (btn) {
        btn.classList.add('speaking');
        utterance.onend = () => btn.classList.remove('speaking');
        utterance.onerror = () => btn.classList.remove('speaking');
    }

    window.speechSynthesis.speak(utterance);
    currentUtterance = utterance;
}

// بارگذاری صداها (بعضی مرورگرها نیاز دارند)
if ('speechSynthesis' in window) {
    window.speechSynthesis.onvoiceschanged = () => {
        window.speechSynthesis.getVoices();
    };
}

// ==========================================
// ریست کردن آزمون
// ==========================================
function resetQuiz() {
    playClickSound();
    window.location.href = window.location.pathname;
}
</script>

</body>
</html>
