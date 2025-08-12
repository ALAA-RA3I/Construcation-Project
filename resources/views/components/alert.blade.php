<style>
    .custom-alert-wrapper {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 400px;
        width: 100%;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .custom-alert {
        padding: 15px 20px;
        margin-bottom: 10px;
        border-radius: 12px;
        font-weight: 500;
        color: white;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        border-left: 6px solid transparent;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: fadeInUp 0.4s ease-out;
    }

    .alert-success {
        background-color: #38c172;
        border-left-color: #2f9e63;
    }

    .alert-error {
        background-color: #e3342f;
        border-left-color: #cc1f1a;
    }

    .custom-alert .icon {
        font-size: 20px;
        line-height: 1;
    }

    .custom-alert .list {
        margin: 5px 0 0;
        padding-left: 18px;
    }

    .custom-alert .list li {
        list-style-type: disc;
        font-size: 14px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


@if(session('success') || session('error') || $errors->any())
    <div class="custom-alert-wrapper" id="custom-alert-wrapper">
        <div class="custom-alert
            @if(session('success')) alert-success
            @elseif(session('error') || $errors->any()) alert-error
            @endif
        ">
            {{-- Success Message --}}
            @if(session('success'))
                <span class="icon">✅</span>
                <div>{{ session('success') }}</div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <span class="icon">❌</span>
                <div>{{ session('error') }}</div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <span class="icon">⚠️</span>
                <div>
                    <strong>Validation Error:</strong>
                    <ul class="list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endif
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const alertWrapper = document.getElementById('custom-alert-wrapper');

        if (alertWrapper) {
            setTimeout(() => {
                alertWrapper.style.transition = 'opacity 0.5s ease';
                alertWrapper.style.opacity = '0';
                setTimeout(() => alertWrapper.remove(), 500); // Remove from DOM after fade out
            }, 8000);
        }
    });
</script>

