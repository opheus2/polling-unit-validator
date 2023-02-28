<x-guest-layout>
    <div class="flex justify-center h-screen w-screen items-center">
        <form class="w-full md:w-1/2 flex flex-col items-center" action="{{ route('login.post') }}" method="POST">
            @csrf
            <!-- text login -->
            <h1 class="text-center text-2xl font-bold text-gray-600 mb-6">LOGIN</h1>
            <!-- email input -->
            <div class="w-3/4 xl:w-2/4 mb-6">
                @error('email')
                    <div class="text-red-500 text-sm pb-2">
                        {{ $message }}
                    </div>
                @enderror

                <input type="email" name="email" id="email"
                    class="w-full py-4 px-8 bg-slate-200 placeholder:font-semibold rounded hover:ring-1 outline-blue-500"
                    placeholder="Email" value="{{old('email')}}">
            </div>
            <!-- password input -->
            <div class="w-3/4 xl:w-2/4 mb-6">
                <input type="password" name="password" id="password"
                    class="w-full py-4 px-8 bg-slate-200 placeholder:font-semibold rounded hover:ring-1 outline-blue-500 "
                    placeholder="Password">
            </div>
            <!-- remember input -->
            {{-- <div class="w-3/4 xl:w-2/4 flex flex-row justify-between">
                <div class=" flex items-center gap-x-1">
                    <input type="checkbox" name="remember" id="" class=" w-4 h-4  ">
                    <label for="" class="text-sm text-slate-400">Remember me</label>
                </div>
                <div>
                    <a href="#" class="text-sm text-slate-400 hover:text-blue-500">Forgot?</a>
                </div>
            </div> --}}
            <!-- button -->
            <div class="w-3/4 xl:w-2/4 mt-4">
                <button type="submit" class="py-4 bg-blue-400 w-full rounded text-blue-50 font-bold hover:bg-blue-700">
                    LOGIN</button>
            </div>
        </form>
    </div>
</x-guest-layout>
