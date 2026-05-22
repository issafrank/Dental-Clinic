<?php
$u = auth();
$isLoggedIn = (bool) $u;
$clinic = e(config('app.name'));

$services = [
    ['bg' => 'from-slate-200 to-slate-400',  'title' => 'Dental Implants',     'desc' => 'Permanent tooth replacement'],
    ['bg' => 'from-slate-300 to-slate-500',  'title' => 'Tooth Extractions',   'desc' => 'Safe and gentle removal'],
    ['bg' => 'from-slate-400 to-slate-600',  'title' => 'Veneers',             'desc' => 'Perfect smile makeover'],
    ['bg' => 'from-slate-500 to-slate-700',  'title' => 'General Dentistry',   'desc' => 'Routine care for all ages'],
    ['bg' => 'from-slate-600 to-slate-800',  'title' => 'Teeth Whitening',     'desc' => 'Brighten your smile'],
    ['bg' => 'from-slate-700 to-slate-900',  'title' => 'Braces & Aligners',   'desc' => 'Straight teeth, confident smile'],
    ['bg' => 'from-zinc-400 to-zinc-600',    'title' => 'Root Canal',          'desc' => 'Pain-free treatment'],
    ['bg' => 'from-zinc-600 to-zinc-800',    'title' => 'Pediatric Dentistry', 'desc' => 'Gentle care for kids'],
];

$stats = [
    ['value' => '10,000+', 'label' => 'Patients served per year'],
    ['value' => '15+',     'label' => 'Years of service'],
    ['value' => '99.7%',   'label' => 'Satisfied patients'],
    ['value' => '4',       'label' => 'Expert dentists'],
];

$dentists = [
    ['name' => 'Dr. Mark Reyes',   'role' => 'General Dentist',  'initial' => 'MR', 'gradient' => 'from-slate-300 to-slate-500'],
    ['name' => 'Dr. Jane Cruz',    'role' => 'Orthodontist',      'initial' => 'JC', 'gradient' => 'from-slate-500 to-slate-700'],
    ['name' => 'Dr. Anna Lim',     'role' => 'Pediatric Dentist', 'initial' => 'AL', 'gradient' => 'from-slate-600 to-slate-800'],
    ['name' => 'Dr. Pedro Santos', 'role' => 'Oral Surgeon',      'initial' => 'PS', 'gradient' => 'from-slate-400 to-slate-600'],
];

$reasons = [
    ['icon' => 'check',     'title' => 'Modern Equipment',  'desc' => 'State-of-the-art tools for precise, comfortable treatment.'],
    ['icon' => 'users',     'title' => 'Experienced Team',  'desc' => 'Licensed dentists with decades of combined experience.'],
    ['icon' => 'sparkles',  'title' => 'Gentle Care',       'desc' => 'Anxiety-friendly approach for nervous patients.'],
    ['icon' => 'banknotes', 'title' => 'Affordable Plans',  'desc' => 'Flexible payment options and HMO partnerships.'],
];

$testimonials = [
    ['name' => 'Maria Santos',    'initial' => 'M', 'gradient' => 'from-slate-500 to-slate-700',
     'quote' => 'Best dental clinic I have been to! The staff is friendly and Dr. Reyes really takes time to explain everything. Highly recommended!'],
    ['name' => 'Juan Dela Cruz',  'initial' => 'J', 'gradient' => 'from-slate-400 to-slate-600',
     'quote' => 'Got my braces here and I am very happy with the results. Dr. Cruz is amazing and the clinic is always clean and comfortable.'],
    ['name' => 'Anna Reyes',      'initial' => 'A', 'gradient' => 'from-slate-600 to-slate-800',
     'quote' => 'My kids love coming here! Dr. Lim is so good with children. We have made this our family dentist for years.'],
    ['name' => 'Carlos Bautista', 'initial' => 'C', 'gradient' => 'from-slate-300 to-slate-500',
     'quote' => 'I expected a lot of pain but the procedure was surprisingly smooth. Recovery was much faster thanks to their advanced technology.'],
];

$hours = [
    ['Monday - Friday', '8:00 AM - 7:00 PM'],
    ['Saturday',        '9:00 AM - 5:00 PM'],
    ['Sunday',          'By appointment only'],
];

$footer_services = ['Dental Implants','Braces','Veneers','Tooth Filling','Orthodontics','Teeth Cleaning','Tooth Extractions','Teeth Whitening','General Dentistry','Pediatric Dentistry','Root Canal Treatment'];
$footer_links    = ['About Us','Services','Contact Us'];
?>

<!-- ================================================================= NAVBAR ================================================================= -->
<header class="sticky top-0 z-30 border-b border-slate-100 bg-white shadow-sm">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
        <a href="<?= e(url('/')) ?>" class="flex items-center gap-2.5">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-slate-900 shadow-sm">
                <?php icon('tooth', 'h-5 w-5 text-white'); ?>
            </span>
            <span class="text-base font-bold tracking-tight text-slate-900"><?= $clinic ?></span>
        </a>

        <div class="hidden items-center gap-8 md:flex">
            <a href="#"             class="text-sm font-medium text-slate-700 transition hover:text-slate-900">Home</a>
            <a href="#about"        class="text-sm font-medium text-slate-600 transition hover:text-slate-900">About Us</a>
            <a href="#services"     class="text-sm font-medium text-slate-600 transition hover:text-slate-900">Services</a>
            <a href="#dentists"     class="text-sm font-medium text-slate-600 transition hover:text-slate-900">Our Dentists</a>
            <a href="#testimonials" class="text-sm font-medium text-slate-600 transition hover:text-slate-900">Reviews</a>
        </div>

        <div class="flex items-center gap-2">
            <?php if ($isLoggedIn): ?>
                <a href="<?= e(url('/dashboard')) ?>" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Staff Portal</a>
            <?php else: ?>
                <a href="<?= e(url('/login')) ?>" class="hidden text-sm font-medium text-slate-600 transition hover:text-slate-900 sm:inline-flex">Staff Login</a>
                <a href="#contact" class="rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">Contact Us</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<!-- ================================================================= HERO ================================================================= -->
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-24 sm:py-32">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white/5 via-transparent to-transparent"></div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-2">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-slate-800/20 px-3 py-1 text-xs font-semibold text-slate-400 ring-1 ring-white/20">
                    <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-white"></span>
                    Now accepting new patients
                </span>
                <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Your <span class="text-slate-300">healthy smile</span><br>starts here.
                </h1>
                <p class="mt-6 text-lg leading-relaxed text-slate-300">
                    Comprehensive dental care for the whole family. Modern technology, gentle approach, affordable prices — all in a comfortable, anxiety-free clinic.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#contact" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-800 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
                        Book Appointment <?php icon('chevron-right', 'h-4 w-4'); ?>
                    </a>
                    <a href="#services" class="inline-flex items-center justify-center gap-2 rounded-lg bg-white/10 px-6 py-3 text-sm font-semibold text-white ring-1 ring-white/20 transition hover:bg-white/15">
                        Our Services
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="overflow-hidden rounded-3xl bg-gradient-to-br from-slate-600 to-slate-900 p-1 shadow-2xl">
                    <div class="flex aspect-[4/3] items-center justify-center rounded-[1.35rem] bg-slate-800">
                        <div class="text-center">
                            <span class="mx-auto inline-flex h-28 w-28 items-center justify-center rounded-full bg-slate-800/20 ring-2 ring-white/20">
                                <?php icon('tooth', 'h-14 w-14 text-slate-300'); ?>
                            </span>
                            <p class="mt-5 text-xl font-bold text-white"><?= $clinic ?></p>
                            <p class="mt-1 text-sm text-slate-400">Caring for smiles since 2010</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-4 -left-4 hidden rounded-2xl bg-white p-4 shadow-xl sm:block">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-900">
                            <?php icon('check', 'h-5 w-5'); ?>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Walk-ins welcome</p>
                            <p class="text-xs text-slate-500">Same-day emergencies</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -right-4 -top-4 hidden rounded-2xl bg-white p-4 shadow-xl sm:block">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-900">
                            <?php icon('clock', 'h-5 w-5'); ?>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Open today</p>
                            <p class="text-xs text-slate-500">8:00 AM &ndash; 7:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================================================= STATS ================================================================= -->
<section class="border-y border-slate-200 bg-white py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 lg:grid-cols-4">
            <?php foreach ($stats as $s): ?>
                <div class="text-center">
                    <p class="text-4xl font-bold text-slate-900 sm:text-5xl"><?= e($s['value']) ?></p>
                    <p class="mt-2 text-sm font-medium text-slate-500"><?= e($s['label']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================================================================= SERVICES ================================================================= -->
<section id="services" class="py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-wider text-slate-900">Our Services</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Complete dental care under one roof</h2>
            <p class="mt-4 text-slate-600">From routine cleanings to complex procedures, we have you covered.</p>
        </div>

        <div class="mt-14 grid grid-cols-2 gap-4 sm:grid-cols-4">
            <?php foreach ($services as $s): ?>
                <div class="group relative overflow-hidden rounded-2xl shadow-md transition hover:-translate-y-1 hover:shadow-xl cursor-pointer">
                    <div class="aspect-square w-full bg-gradient-to-br <?= e($s['bg']) ?> flex items-center justify-center">
                        <?php icon('tooth', 'h-16 w-16 text-white/25'); ?>
                    </div>
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/75 to-transparent p-4">
                        <p class="text-sm font-bold text-white"><?= e($s['title']) ?></p>
                        <p class="mt-0.5 text-xs text-white/75"><?= e($s['desc']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================================================================= ABOUT ================================================================= -->
<section id="about" class="border-y border-slate-200 bg-slate-50 py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-14 lg:grid-cols-2">
            <!-- Image stack -->
            <div class="flex gap-4">
                <div class="flex flex-1 flex-col gap-4">
                    <div class="overflow-hidden rounded-2xl bg-gradient-to-br from-slate-400 to-slate-600 shadow-lg" style="aspect-ratio:3/4">
                        <div class="flex h-full items-center justify-center">
                            <?php icon('home', 'h-16 w-16 text-white/25'); ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-4 pt-8">
                    <div class="overflow-hidden rounded-2xl bg-gradient-to-br from-slate-400 to-slate-600 shadow-lg" style="aspect-ratio:1/1">
                        <div class="flex h-full items-center justify-center">
                            <?php icon('users', 'h-14 w-14 text-white/25'); ?>
                        </div>
                    </div>
                    <div class="overflow-hidden rounded-2xl bg-gradient-to-br from-slate-600 to-slate-800 shadow-lg" style="aspect-ratio:16/9">
                        <div class="flex h-full items-center justify-center">
                            <?php icon('tooth', 'h-10 w-10 text-white/25'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Text -->
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-slate-900">About Us</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">We are committed to your smile</h2>
                <p class="mt-4 leading-relaxed text-slate-600">
                    At <?= $clinic ?>, our mission is simple yet powerful: to deliver healthy, confident, and radiant smiles to every patient we serve. We believe a beautiful smile is more than just aesthetics — it's the foundation of self-confidence, better communication, and a higher quality of life.
                </p>
                <p class="mt-4 leading-relaxed text-slate-600">
                    With a team of highly experienced dentists trained both locally and internationally, combined with cutting-edge technology, we are committed to providing premium-quality, safe, and pain-free dental care at truly reasonable prices.
                </p>
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <?php foreach ($reasons as $r): ?>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-900">
                                <?php icon($r['icon'], 'h-4 w-4'); ?>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900"><?= e($r['title']) ?></p>
                                <p class="mt-0.5 text-xs text-slate-500"><?= e($r['desc']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="#contact" class="mt-8 inline-flex items-center gap-2 rounded-lg border-2 border-slate-900 px-5 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-slate-900 hover:text-white">
                    Know More <?php icon('chevron-right', 'h-4 w-4'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ================================================================= DENTISTS ================================================================= -->
<section id="dentists" class="py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-xl text-center">
            <p class="text-sm font-semibold uppercase tracking-wider text-slate-900">Meet The Team</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Our Dentists</h2>
        </div>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($dentists as $d): ?>
                <div class="overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200 transition hover:shadow-lg text-center">
                    <div class="flex aspect-[3/4] items-center justify-center bg-gradient-to-br <?= e($d['gradient']) ?>">
                        <span class="text-6xl font-bold text-white/30"><?= e($d['initial']) ?></span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-slate-900"><?= e($d['name']) ?></h3>
                        <p class="mt-0.5 text-sm text-slate-900"><?= e($d['role']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================================================================= TESTIMONIALS ================================================================= -->
<section id="testimonials" class="border-t border-slate-200 bg-slate-50 py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-wider text-slate-900">Reviews</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">What are customers' reviews?</h2>
        </div>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($testimonials as $t): ?>
                <div class="flex flex-col rounded-2xl bg-white p-6 ring-1 ring-slate-200 transition hover:shadow-md">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-gradient-to-br <?= e($t['gradient']) ?> text-sm font-bold text-white">
                            <?= e($t['initial']) ?>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900"><?= e($t['name']) ?></p>
                            <span class="text-amber-400 text-xs">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                        </div>
                    </div>
                    <p class="mt-4 flex-1 text-sm leading-relaxed text-slate-600"><?= e($t['quote']) ?></p>
                    <div class="mt-5 flex items-center gap-1.5 border-t border-slate-100 pt-4">
                        <span class="text-[11px] font-semibold text-slate-400">via</span>
                        <span class="text-sm font-bold">
                            <span class="font-bold tracking-tight text-slate-700">Google</span>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================================================================= BOOK APPOINTMENT ================================================================= -->
<section id="contact" class="py-20 sm:py-28">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-slate-200 lg:grid lg:grid-cols-2">
            <!-- Teal side -->
            <div class="flex flex-col items-center justify-center bg-gradient-to-br from-slate-800 to-slate-950 p-10 text-white">
                <span class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-white/15">
                    <?php icon('tooth', 'h-10 w-10 text-white'); ?>
                </span>
                <h3 class="mt-5 text-2xl font-bold">We Are Open</h3>
                <p class="mt-1 text-slate-300">And Welcoming Patients</p>
                <div class="mt-8 w-full max-w-xs space-y-2 text-sm">
                    <?php foreach ($hours as [$day, $time]): ?>
                        <div class="flex justify-between gap-4 border-b border-white/20 pb-2">
                            <span class="text-slate-300"><?= e($day) ?></span>
                            <span class="font-semibold"><?= e($time) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-8 space-y-2 text-sm text-slate-300">
                    <div class="flex items-center gap-2">
                        <?php icon('bell', 'h-4 w-4 text-slate-400'); ?>
                        <a href="tel:+63212345678" class="hover:text-white">(02) 1234 5678 &nbsp;|&nbsp; +63 917 123 4567</a>
                    </div>
                    <div class="flex items-start gap-2">
                        <?php icon('home', 'h-4 w-4 mt-0.5 text-slate-400 shrink-0'); ?>
                        <span>123 Smile Avenue, Quezon City, Metro Manila</span>
                    </div>
                </div>
            </div>

            <!-- Form side -->
            <div class="p-8 sm:p-12">
                <h3 class="text-2xl font-bold text-slate-900">Book an Appointment</h3>
                <p class="mt-1 text-sm text-slate-500">Fill out the form and we will contact you shortly.</p>
                <form class="mt-8 space-y-5">
                    <div class="relative mt-3">
                        <input class="peer w-full rounded-lg border border-slate-200 bg-white px-3 py-3 text-sm shadow-sm placeholder:text-transparent focus:placeholder:text-slate-400 focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200"
                               type="text" id="book_name" name="book_name" placeholder="Full Name*">
                        <label class="pointer-events-none absolute left-2.5 -top-2 bg-white px-1 text-xs font-medium text-slate-500 transition-all duration-200 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-slate-400 peer-placeholder-shown:bg-transparent peer-focus:-top-2 peer-focus:text-xs peer-focus:bg-white peer-focus:text-slate-900"
                               for="book_name">Full Name*</label>
                    </div>
                    <div class="relative mt-3">
                        <input class="peer w-full rounded-lg border border-slate-200 bg-white px-3 py-3 text-sm shadow-sm placeholder:text-transparent focus:placeholder:text-slate-400 focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200"
                               type="tel" id="book_phone" name="book_phone" placeholder="Mobile Number*">
                        <label class="pointer-events-none absolute left-2.5 -top-2 bg-white px-1 text-xs font-medium text-slate-500 transition-all duration-200 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-slate-400 peer-placeholder-shown:bg-transparent peer-focus:-top-2 peer-focus:text-xs peer-focus:bg-white peer-focus:text-slate-900"
                               for="book_phone">Mobile Number*</label>
                    </div>
                    <div class="relative mt-3">
                        <input class="peer w-full rounded-lg border border-slate-200 bg-white px-3 py-3 text-sm shadow-sm placeholder:text-transparent focus:placeholder:text-slate-400 focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200"
                               type="email" id="book_email" name="book_email" placeholder="Email Address">
                        <label class="pointer-events-none absolute left-2.5 -top-2 bg-white px-1 text-xs font-medium text-slate-500 transition-all duration-200 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-slate-400 peer-placeholder-shown:bg-transparent peer-focus:-top-2 peer-focus:text-xs peer-focus:bg-white peer-focus:text-slate-900"
                               for="book_email">Email Address</label>
                    </div>
                    <button type="submit" class="mt-2 w-full rounded-lg border-2 border-slate-900 px-6 py-3 text-sm font-bold uppercase tracking-widest text-slate-900 transition hover:bg-slate-900 hover:text-white">
                        Book an Appointment
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ================================================================= FOOTER ================================================================= -->
<footer class="bg-slate-800 text-white">
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white/15">
                        <?php icon('tooth', 'h-5 w-5 text-white'); ?>
                    </span>
                    <span class="text-lg font-bold"><?= $clinic ?></span>
                </div>
                <p class="mt-4 text-sm leading-relaxed text-slate-300">
                    <?= $clinic ?> is a leading dental clinic committed to providing premium-quality dental care at affordable prices.
                </p>
            </div>

            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Our Services</h4>
                <ul class="mt-4 space-y-2">
                    <?php foreach ($footer_services as $fs): ?>
                        <li><a href="#services" class="text-sm text-slate-300 transition hover:text-white">&bull; <?= e($fs) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Quick Links</h4>
                <ul class="mt-4 space-y-2">
                    <?php foreach ($footer_links as $fl): ?>
                        <li><a href="#" class="text-sm text-slate-300 transition hover:text-white">&bull; <?= e($fl) ?></a></li>
                    <?php endforeach; ?>
                    <?php if (!$isLoggedIn): ?>
                        <li><a href="<?= e(url('/login')) ?>" class="text-sm text-slate-300 transition hover:text-white">&bull; Staff Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Contact Us</h4>
                <ul class="mt-4 space-y-3 text-sm text-slate-300">
                    <li class="flex items-start gap-2">
                        <?php icon('clock', 'h-4 w-4 mt-0.5 shrink-0 text-slate-400'); ?>
                        <span>8:30 AM &ndash; 7 PM<br><span class="text-xs">Monday to Sunday</span></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <?php icon('bell', 'h-4 w-4 shrink-0 text-slate-400'); ?>
                        <a href="tel:+63212345678" class="hover:text-white">(02) 1234 5678</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <?php icon('bell', 'h-4 w-4 shrink-0 text-slate-400'); ?>
                        <a href="mailto:hello@dentalclinic.com" class="hover:text-white">hello@dentalclinic.com</a>
                    </li>
                    <li class="flex items-start gap-2">
                        <?php icon('home', 'h-4 w-4 mt-0.5 shrink-0 text-slate-400'); ?>
                        <span>123 Smile Avenue, Quezon City, Metro Manila, Philippines</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-12 border-t border-slate-700 pt-6 text-center text-xs text-slate-400">
            &copy; <?= date('Y') ?> <?= $clinic ?>. All Rights Reserved.
        </div>
    </div>
</footer>
