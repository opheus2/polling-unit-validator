<x-app-layout>
    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Submission {{ $image->id }}</h1>
        </div>
        <div class="mx-auto max-w-7xl">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        {{-- <h1 class="text-base font-semibold leading-6 text-gray-900">Users</h1> --}}
                        <p class="mt-2 text-sm text-gray-700">File: <a class="text-blue-700"
                                href="{{ $image->url }}">{{ $image->path }}</a> - Unique Submissions:
                            {{ $image->count }}</p>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full">
                                <thead class="bg-white">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                            Party Name</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Score</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Has
                                            Corrections</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Is Unclear
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($submissions as $submission)
                                        <tr class="border-t border-gray-200">
                                            <th colspan="5" scope="colgroup"
                                                class="bg-gray-50 py-2 pl-4 pr-3 text-sm font-semibold text-gray-900 sm:pl-3">
                                                IP Address: {{ $submission[0]->ip_address }} -
                                                {{ $submission[0]->created_at->diffForHumans() }}
                                                <br>
                                                <form class="flex justify-center pt-4"
                                                    action="{{ route('submissions.validate', $submission[0]->session_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="block rounded-md bg-indigo-600 py-1.5 px-3 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Validate</button>
                                                </form>
                                            </th>
                                        </tr>

                                        @foreach ($submission as $data)
                                            <tr class="border-t border-gray-300">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                                                    {{ $data->party->name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ $data->score }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    @if ($data->party->has_corrections)
                                                        <span class='text-red-500'>Yes</span>
                                                    @else
                                                        <span class='text-green-500'>No</span>
                                                    @endif
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    @if ($data->party->has_corrections)
                                                        <span class='text-red-500'>Yes</span>
                                                    @else
                                                        <span class='text-green-500'>No</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
