<x-app-layout>
    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Pending Submission</h1>
        </div>
        <div class="mx-auto max-w-7xl">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <p class="mt-2 text-sm text-gray-700">A list of all pending submissions.</p>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                            File Name/Path</th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Unique
                                            Submissions</th>
                                        <th scope="col"
                                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Last
                                            Submission At</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @if ($submissions->isEmpty())
                                        <tr>
                                            <td colspan="4" class="font-bold text-center py-4 px-3 text-sm text-gray-500">
                                                No more pending submissions found.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($submissions as $submission)
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                    <a class="text-blue-700"
                                                        href="{{ $submission->url }}">{{ $submission->path }}</a>
                                                </td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                    {{ number_format($submission->count) }}</td>
                                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                    {{ $submission->updated_at->diffForHumans() }}</td>
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                                    <a href="{{ route('submissions.show', $submission) }}}"
                                                        class="text-indigo-600 hover:text-indigo-900">View<span
                                                            class="sr-only">, Lindsay Walton</span></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
