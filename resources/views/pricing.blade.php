<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="https://wecares.in/images/logo_1728988640.png" />

<!-- Section 6 -->
<section class="box-border py-8 leading-7 text-gray-900 bg-white border-0 border-gray-200 border-solid sm:py-12 md:py-16 lg:py-24">
    <div class="box-border max-w-6xl px-4 pb-12 mx-auto border-solid sm:px-6 md:px-6 lg:px-4">
        <div class="flex flex-col items-center leading-7 text-center text-gray-900">
            <h2 class="box-border m-0 text-3xl font-semibold leading-tight tracking-tight text-black border-solid sm:text-4xl md:text-5xl">
                Pricing Options
            </h2>
            <p class="box-border mt-4 text-2xl leading-normal text-gray-900 border-solid">
                We've got a plan for companies of any size
            </p>
        </div>
        <div class="grid max-w-md mx-auto mt-6 overflow-hidden leading-7 text-gray-900 border border-b-4 border-gray-300 border-blue-600 rounded-xl md:max-w-lg lg:max-w-none sm:mt-10 lg:grid-cols-3">
            @foreach ($plans as $plan)
            <div class="box-border px-4 py-8 mb-6 text-center bg-white border-solid lg:mb-0 sm:px-4 sm:py-8 md:px-8 md:py-12 lg:px-10">
                <h3 class="m-0 text-2xl font-semibold leading-tight tracking-tight text-black border-0 border-solid sm:text-3xl md:text-4xl">
                    {{ $plan->name }}
                </h3>
                <p class="mt-3 leading-7 text-gray-900 border-0 border-solid">
                    {{ $plan->description }}
                </p>
                <div class="flex items-center justify-center mt-6 leading-7 text-gray-900 border-0 border-solid sm:mt-8">
                    <p class="box-border m-0 text-6xl font-semibold leading-normal text-center border-0 border-gray-200">
                        ${{ $plan->price }}
                    </p>
                    <p class="box-border my-0 ml-4 mr-0 text-xs text-left border-0 border-gray-200">
                        per user <span class="block">per month</span>
                    </p>
                </div>
                <form action="{{ route('initiatePayment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <button type="submit">Select Plan</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</section>