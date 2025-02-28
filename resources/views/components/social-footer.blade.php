@props(['socials' => [], 'classBtn' => '', 'classGoogle' => ''])

<div class="w-100 ">

    <style>
        /* CSS */
        .btn-custom {
            background-color: #c4a484;
            color: white;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 500;
        }

        .btn-custom:hover {
            background-color: #aa7d51;
            color: white;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border: 2px solid #c4a484;
            border-radius: 50%;
            color: #232323;
            font-size: 24px;
            transition: color 0.3s, border-color 0.3s;
            text-decoration: none;
        }

        .social-icon:hover {
            color: #c4a484;
            border-color: #c4a484;
        }
    </style>

    <div class="my-4 text-center">
        @if ($socials['google_review_link'])
            <a href="{{ $socials['google_review_link'] }}"
                {{ $attributes->merge(['class' => 'mb-3 btn btn-custom ' . $classGoogle]) }}>
                {{ __('publicmenu.google_review_msg') }}
            </a>
        @endif
        <div class="social-icons">

            @if($socials['site_link'])
                <a href="{{ $socials['site_link'] }}" class="social-icon">
                    <i class="fas fa-globe"></i>
                </a>
            @endif

            @if($socials['facebook_link'])
                <a href="{{ $socials['facebook_link'] }}" class="social-icon">
                    <i class="fab fa-facebook-f"></i>
                </a>
            @endif

            @if($socials['instagram_link'])
                <a href="{{ $socials['instagram_link'] }}" class="social-icon">
                    <i class="fab fa-instagram"></i>
                </a>
            @endif

        </div>
    </div>
</div>
