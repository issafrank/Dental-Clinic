<?php
$u = auth();
$isLoggedIn = (bool) $u;
$clinic = e(config('app.name'));

$services = [
    ['icon' => 'tooth',         'tint' => 'bg-blue-500/10 text-blue-600 ring-blue-500/20',
     'title' => 'General Dentistry',
     'desc'  => 'Routine check-ups, cleanings, fillings, and preventive care for the whole family.',
     'price' => 'from ₱500'],
    ['icon' => 'sparkles',      'tint' => 'bg-fuchsia-500/10 text-fuchsia-600 ring-fuchsia-500/20',
     'title' => 'Teeth Whitening',
     'desc'  => 'Professional in-office whitening for a brighter, more confident smile in one visit.',
     'price' => 'from ₱6,500'],
    ['icon' => 'identification','tint' => 'bg-emerald-500/10 text-emerald-600 ring-emerald-500/20',
     'title' => 'Braces & Aligners',
     'desc'  => 'Traditional braces and clear aligners to straighten teeth at any age.',
     'price' => 'from ₱35,000'],
    ['icon' => 'users',         'tint' => 'bg-amber-500/10 text-amber-600 ring-amber-500/20',
     'title' => 'Pediatric Dentistry',
     'desc'  => 'Gentle, fun, and friendly dental care designed for children of all ages.',
     'price' => 'from ₱400'],
    ['icon' => 'briefcase',     'tint' => 'bg-rose-500/10 text-rose-600 ring-rose-500/20',
     'title' => 'Oral Surgery',
     'desc'  => 'Tooth extractions, wisdom teeth removal, and minor surgical procedures.',
     'price' => 'from ₱2,500'],
    ['icon' => 'check',         'tint' => 'bg-indigo-500/10 text-indigo-600 ring-indigo-500/20',
     'title' => 'Dental Implants',
     'desc'  => 'Permanent, natural-looking replacements for missing teeth.',
     'price' => 'from ₱45,000'],
];

$dentists = [
    ['name' => 'Dr. Mark Reyes',  'role' => 'General Dentist',     'tag' => 'Lead Dentist',
     'bio'  => '12+ years experience in family and cosmetic dentistry.',
     'initial' => 'MR', 'gradient' => 'from-blue-500 to-blue-700'],
    ['name' => 'Dr. Jane Cruz',   'role' => 'Orthodontist',        'tag' => 'Braces Specialist',
     'bio'  => 'Certified specialist in braces and clear aligners.',
     'initial' => 'JC', 'gradient' => 'from-fuchsia-500 to-fuchsia-700'],
    ['name' => 'Dr. Anna Lim',    'role' => 'Pediatric Dentist',   'tag' => 'Kids Favorite',
     'bio'  => 'Making dental visits fun and stress-free for kids.',
     'initial' => 'AL', 'gradient' => 'from-emerald-500 to-emerald-700'],
    ['name' => 'Dr. Pedro Santos','role' => 'Oral Surgeon',        'tag' => 'Surgery Lead',
     'bio'  => 'Expert in extractions and dental implant surgery.',
     'initial' => 'PS', 'gradient' => 'from-amber-500 to-amber-700'],
];

$reasons = [
    ['icon' => 'check',     'title' => 'Modern Equipment',
     'desc'  => 'State-of-the-art tools for precise, comfortable treatment.'],
    ['icon' => 'users',     'title' => 'Experienced Team',
     'desc'  => 'Licensed dentists with decades of combined experience.'],
    ['icon' => 'sparkles',  'title' => 'Gentle Care',
     'desc'  => 'Anxiety-friendly approach for nervous patients.'],
    ['icon' => 'banknotes', 'title' => 'Affordable Plans',
     'desc'  => 'Flexible payment options and HMO partnerships.'],
];

$testimonials = [
    ['name' => 'Maria Santos', 'role' => 'Patient since 2022', 'initial' => 'M',
     'quote' => 'Best dental clinic I have been to! The staff is friendly and Dr. Reyes really takes time to explain everything. Highly recommended!',
     'rating' => 5],
    ['name' => 'Juan Dela Cruz', 'role' => 'Patient since 2023', 'initial' => 'J',
     'quote' => 'Got my braces here and I am very happy with the results. Dr. Cruz is amazing and the clinic is always clean and comfortable.',
     'rating' => 5],
    ['name' => 'Anna Reyes', 'role' => 'Patient since 2021', 'initial' => 'A',
     'quote' => 'My kids love coming here! Dr. Lim is so good with children. We have made this our family dentist for years.',
     'rating' => 5],
];

$hours = [
    ['Monday - Friday',  '8:00 AM - 7:00 PM'],
    ['Saturday',         '9:00 AM - 5:00 PM'],
    ['Sunday',           'By appointment only'],
];
?>

<!-- =================================================================
     NAVBAR
     ================================================================= -->
<header class="sticky top-0 z-30 border-b border-slate-200/70 bg-white/80 backdrop-blur dark:border-slate-800/70 dark:bg-slate-950/80">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
        <a href="<?= e(url('/')) ?>" class="flex items-center gap-2.5">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-700 shadow-sm">
                <?php icon('tooth', 'h-5 w-5 text-white'); ?>
            </span>
            <span class="text-base font-bold tracking-tight text-slate-900 dark:text-white"><?= $clinic ?></span>
        </a>

        <div class="hidden items-center gap-8 md:flex">
            <a href="#services"     class="text-sm font-medium text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">Services</a>
            <a href="#dentists"     class="text-sm font-medium text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">Our Dentists</a>
            <a href="#about"        class="text-sm font-medium text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">Why Us</a>
            <a href="#testimonials" class="text-sm font-medium text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">Reviews</a>
            <a href="#contact"      class="text-sm font-medium text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">Contact</a>
        </div>

        <div class="flex items-center gap-2">
            <button data-theme-toggle
                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-700 transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800"
                    aria-label="Toggle theme" title="Toggle theme">
                <span class="dark:hidden"><?php icon('moon', 'h-5 w-5'); ?></span>
                <span class="hidden dark:inline-flex"><?php icon('sun', 'h-5 w-5 text-amber-400'); ?></span>
            </button>

            <?php if ($isLoggedIn): ?>
                <a href="<?= e(url('/dashboard')) ?>" class="btn-primary">Staff Portal</a>
            <?php else: ?>
                <a href="<?= e(url('/login')) ?>" class="hidden btn-ghost sm:inline-flex">Staff Login</a>
                <a href="#contact" class="btn-primary">Book Appointment</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<!-- =================================================================
     HERO
     ================================================================= -->
<section class="relative overflow-hidden">
    <div aria-hidden="true" class="pointer-events-none absolute -top-40 left-1/2 -z-10 h-[40rem] w-[80rem] -translate-x-1/2 bg-gradient-to-br from-blue-200/40 via-cyan-200/30 to-emerald-200/40 blur-3xl dark:from-blue-900/30 dark:via-cyan-900/20 dark:to-emerald-900/30"></div>

    <div class="mx-auto max-w-7xl px-4 pb-20 pt-16 sm:px-6 sm:pt-24 lg:px-8 lg:pt-28">
        <div class="grid items-center gap-12 lg:grid-cols-2">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 ring-1 ring-blue-200 dark:bg-blue-500/10 dark:text-blue-300 dark:ring-blue-500/30">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Now accepting new patients
                </span>

                <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl dark:text-white">
                    Your healthy
                    <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent dark:from-blue-400 dark:to-cyan-400">
                        smile
                    </span>
                    starts here.
                </h1>

                <p class="mt-6 text-lg text-slate-600 dark:text-slate-300">
                    Comprehensive dental care for the whole family. Our compassionate team uses modern technology to keep your smile bright and healthy &mdash; in a comfortable, anxiety-free environment.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#contact" class="btn-primary">
                        Book Appointment <?php icon('chevron-right', 'h-4 w-4'); ?>
                    </a>
                    <a href="#services" class="btn-secondary">
                        Our Services
                    </a>
                </div>

                <!-- Trust badges -->
                <div class="mt-10 flex flex-wrap items-center gap-6 border-t border-slate-200 pt-6 dark:border-slate-800">
                    <div>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">15+</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Years serving the community</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">10,000+</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Happy patients</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">4.9 &#9733;</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Average rating</p>
                    </div>
                </div>
            </div>

            <!-- Hero illustration / image card -->
            <div class="relative">
                <div class="aspect-square w-full overflow-hidden rounded-3xl bg-gradient-to-br from-blue-500 via-cyan-500 to-emerald-500 p-1 shadow-2xl">
                    <div class="flex h-full w-full items-center justify-center rounded-[1.4rem] bg-white dark:bg-slate-900">
                        <div class="text-center">
                            <span class="mx-auto inline-flex h-32 w-32 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg">
                                <?php icon('tooth', 'h-16 w-16 text-white'); ?>
                            </span>
                            <p class="mt-6 text-2xl font-bold text-slate-900 dark:text-white"><?= $clinic ?></p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Caring for smiles since 2010</p>
                        </div>
                    </div>
                </div>

                <!-- Floating badge -->
                <div class="absolute -bottom-4 -left-4 hidden rounded-2xl bg-white p-4 shadow-xl ring-1 ring-slate-200 sm:block dark:bg-slate-900 dark:ring-slate-700">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                            <?php icon('check', 'h-5 w-5'); ?>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Walk-ins welcome</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Same-day emergencies</p>
                        </div>
                    </div>
                </div>

                <div class="absolute -right-4 -top-4 hidden rounded-2xl bg-white p-4 shadow-xl ring-1 ring-slate-200 sm:block dark:bg-slate-900 dark:ring-slate-700">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                            <?php icon('clock', 'h-5 w-5'); ?>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Open today</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">8:00 AM &ndash; 7:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =================================================================
     SERVICES
     ================================================================= -->
<section id="services" class="border-y border-slate-200 bg-slate-50 py-20 sm:py-28 dark:border-slate-800 dark:bg-slate-900/50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-400">Our Services</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                Complete dental care under one roof
            </h2>
            <p class="mt-4 text-lg text-slate-600 dark:text-slate-300">
                From routine cleanings to complex procedures, we offer a full range of dental services.
            </p>
        </div>

        <div class="mx-auto mt-16 grid max-w-6xl gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($services as $s): ?>
                <div class="group rounded-2xl bg-white p-6 ring-1 ring-slate-200 transition hover:-translate-y-0.5 hover:shadow-lg hover:ring-slate-300 dark:bg-slate-900 dark:ring-slate-800 dark:hover:ring-slate-700">
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl ring-1 ring-inset <?= e($s['tint']) ?>">
                        <?php icon($s['icon'], 'h-5 w-5'); ?>
                    </span>
                    <h3 class="mt-4 text-base font-semibold text-slate-900 dark:text-white"><?= e($s['title']) ?></h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-400"><?= e($s['desc']) ?></p>
                    <p class="mt-4 text-sm font-semibold text-blue-600 dark:text-blue-400"><?= e($s['price']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- =================================================================
     DENTISTS
     ================================================================= -->
<section id="dentists" class="py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-400">Meet The Team</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                Experienced dentists you can trust
            </h2>
            <p class="mt-4 text-lg text-slate-600 dark:text-slate-300">
                Our team of licensed professionals is dedicated to providing you with the best care possible.
            </p>
        </div>

        <div class="mx-auto mt-16 grid max-w-6xl gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($dentists as $d): ?>
                <div class="rounded-2xl bg-white p-6 text-center ring-1 ring-slate-200 transition hover:shadow-lg dark:bg-slate-900 dark:ring-slate-800">
                    <span class="mx-auto inline-flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br <?= e($d['gradient']) ?> text-2xl font-bold text-white shadow-md">
                        <?= e($d['initial']) ?>
                    </span>
                    <h3 class="mt-4 text-base font-semibold text-slate-900 dark:text-white"><?= e($d['name']) ?></h3>
                    <p class="text-sm text-blue-600 dark:text-blue-400"><?= e($d['role']) ?></p>
                    <span class="mt-2 inline-block rounded-full bg-slate-100 px-2.5 py-0.5 text-[10px] font-semibold text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <?= e($d['tag']) ?>
                    </span>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-400"><?= e($d['bio']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- =================================================================
     WHY US
     ================================================================= -->
<section id="about" class="border-y border-slate-200 bg-slate-50 py-20 sm:py-28 dark:border-slate-800 dark:bg-slate-900/50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-400">Why Choose Us</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                Care that puts you first
            </h2>
        </div>

        <div class="mx-auto mt-16 grid max-w-5xl gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($reasons as $r): ?>
                <div class="rounded-2xl bg-white p-6 text-center ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
                    <span class="mx-auto inline-flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                        <?php icon($r['icon'], 'h-6 w-6'); ?>
                    </span>
                    <h3 class="mt-4 text-base font-semibold text-slate-900 dark:text-white"><?= e($r['title']) ?></h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400"><?= e($r['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- =================================================================
     TESTIMONIALS
     ================================================================= -->
<section id="testimonials" class="py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-400">Testimonials</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                What our patients say
            </h2>
        </div>

        <div class="mx-auto mt-16 grid max-w-6xl gap-6 lg:grid-cols-3">
            <?php foreach ($testimonials as $t): ?>
                <div class="rounded-2xl bg-white p-6 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
                    <div class="flex items-center gap-1 text-amber-400">
                        <?php for ($i = 0; $i < $t['rating']; $i++): ?>&#9733;<?php endfor; ?>
                    </div>
                    <p class="mt-4 text-sm leading-6 text-slate-700 dark:text-slate-300">&ldquo;<?= e($t['quote']) ?>&rdquo;</p>
                    <div class="mt-6 flex items-center gap-3 border-t border-slate-100 pt-4 dark:border-slate-800">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-slate-600 to-slate-800 text-sm font-semibold text-white">
                            <?= e($t['initial']) ?>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white"><?= e($t['name']) ?></p>
                            <p class="text-xs text-slate-500 dark:text-slate-400"><?= e($t['role']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- =================================================================
     CONTACT / BOOK
     ================================================================= -->
<section id="contact" class="border-t border-slate-200 bg-slate-50 py-20 sm:py-28 dark:border-slate-800 dark:bg-slate-900/50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-400">Get In Touch</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                Book your visit today
            </h2>
            <p class="mt-4 text-lg text-slate-600 dark:text-slate-300">
                Walk-ins welcome, but appointments are preferred. Reach us anytime.
            </p>
        </div>

        <div class="mx-auto mt-16 grid max-w-6xl gap-6 lg:grid-cols-3">
            <!-- Address -->
            <div class="rounded-2xl bg-white p-6 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <?php icon('home', 'h-6 w-6'); ?>
                </span>
                <h3 class="mt-4 text-base font-semibold text-slate-900 dark:text-white">Visit Us</h3>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                    123 Smile Avenue<br>
                    Quezon City, Metro Manila<br>
                    Philippines 1100
                </p>
            </div>

            <!-- Phone / Email -->
            <div class="rounded-2xl bg-white p-6 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                    <?php icon('bell', 'h-6 w-6'); ?>
                </span>
                <h3 class="mt-4 text-base font-semibold text-slate-900 dark:text-white">Call or Email</h3>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                    <a href="tel:+6321234567" class="hover:text-blue-600 dark:hover:text-blue-400">(02) 1234 5678</a><br>
                    <a href="tel:+639171234567" class="hover:text-blue-600 dark:hover:text-blue-400">+63 917 123 4567</a><br>
                    <a href="mailto:hello@<?= strtolower(str_replace(' ', '', $clinic)) ?>.com" class="hover:text-blue-600 dark:hover:text-blue-400">hello@dentalclinic.com</a>
                </p>
            </div>

            <!-- Hours -->
            <div class="rounded-2xl bg-white p-6 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-fuchsia-100 text-fuchsia-600 dark:bg-fuchsia-500/10 dark:text-fuchsia-400">
                    <?php icon('clock', 'h-6 w-6'); ?>
                </span>
                <h3 class="mt-4 text-base font-semibold text-slate-900 dark:text-white">Office Hours</h3>
                <dl class="mt-2 space-y-1 text-sm text-slate-600 dark:text-slate-400">
                    <?php foreach ($hours as [$day, $time]): ?>
                        <div class="flex justify-between gap-4">
                            <dt class="font-medium text-slate-700 dark:text-slate-300"><?= e($day) ?></dt>
                            <dd><?= e($time) ?></dd>
                        </div>
                    <?php endforeach; ?>
                </dl>
            </div>
        </div>

        <!-- Big CTA -->
        <div class="mx-auto mt-12 max-w-4xl">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 via-blue-700 to-cyan-600 p-10 text-center shadow-xl sm:p-14">
                <div aria-hidden="true" class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-cyan-400/30 blur-3xl"></div>
                <div aria-hidden="true" class="pointer-events-none absolute -bottom-20 -left-20 h-64 w-64 rounded-full bg-blue-400/30 blur-3xl"></div>
                <h3 class="text-2xl font-bold text-white sm:text-3xl">Ready for a healthier smile?</h3>
                <p class="mx-auto mt-3 max-w-xl text-blue-100">Book an appointment today &mdash; new patients always welcome.</p>
                <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    <a href="tel:+6321234567" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-6 py-3 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-100 sm:w-auto">
                        Call (02) 1234 5678
                    </a>
                    <a href="mailto:hello@dentalclinic.com" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white/10 px-6 py-3 text-sm font-semibold text-white ring-1 ring-inset ring-white/20 transition hover:bg-white/20 sm:w-auto">
                        Send a Message
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =================================================================
     FOOTER
     ================================================================= -->
<footer class="border-t border-slate-200 bg-white py-10 dark:border-slate-800 dark:bg-slate-950">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
            <div class="flex items-center gap-2.5">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-700">
                    <?php icon('tooth', 'h-4 w-4 text-white'); ?>
                </span>
                <span class="text-sm font-semibold text-slate-900 dark:text-white"><?= $clinic ?></span>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                &copy; <?= date('Y') ?> <?= $clinic ?>. All rights reserved.
            </p>
            <div class="flex items-center gap-5 text-xs text-slate-500 dark:text-slate-400">
                <a href="#" class="transition hover:text-slate-900 dark:hover:text-white">Privacy</a>
                <a href="#" class="transition hover:text-slate-900 dark:hover:text-white">Terms</a>
                <?php if (!$isLoggedIn): ?>
                    <a href="<?= e(url('/login')) ?>" class="transition hover:text-slate-900 dark:hover:text-white">Staff Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
