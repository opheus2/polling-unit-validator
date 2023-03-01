<x-app-layout>
    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        </div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-3">
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">States</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                            {{ number_format($statesCount) }}</dd>
                    </div>

                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">LGAs</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                            {{ number_format($lgasCount) }}</dd>
                    </div>

                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">Polling Units</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                            {{ number_format($pollingUnitsCount) }}
                        </dd>
                    </div>
                </dl>
            </div>
            <hr class="my-6 border-1 rounded-full border-gray-200">
            <div>
                <h3 class="text-base font-semibold leading-6 text-gray-900">Updated hourly</h3>
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">Total Submissions</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                            {{ number_format($submissionsCount) }}</dd>
                    </div>

                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">Total Validated Submissions</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                            {{ number_format($validatedSubmissionsCount) }}</dd>
                    </div>

                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">Total Pending Validation</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ number_format($pendingValidationCount) }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
