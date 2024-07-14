@extends('layouts.master')

@section('content')
    <section class="bg-white w-full dark:bg-gray-900">
        <div class="px-4 mx-auto lg:py-8">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Exam Fee Payment Edit Form</h2>
            <form action="{{ route('examfeepayments.update', $examfeepayment->id) }}" method="post">
                @csrf @method('put')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="center" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Center</label>
                        <select id="center" name="center_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option disabled selected="">Choose Center</option>
                            @foreach ($centers as $center)
                                <option value="{{ $center->id }}" @if ($examfeepayment->center_id == $center->id || auth()->user()->center_id == $center->id) selected @endif>
                                    {{ $center->name }} ({{ $center->code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="exam_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Exam
                            Date</label>
                        <input type="date" name="exam_date" id="exam_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('exam_date') border-red-500 @enderror"
                            value="{{ old('exam_date', $examfeepayment->exam_date) }}" required="">
                        @error('exam_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="student_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student
                            Name</label>
                        <input type="text" name="student_name" id="student_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('student_name') border-red-500 @enderror"
                            placeholder="Enter Student Name"
                            value="{{ old('student_name', $examfeepayment->student_name) }}" required="">
                        @error('student_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="phone_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                            Number
                        </label>
                        <input type="number" name="phone_no" id="phone_no"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('phone_no') border-red-500 @enderror"
                            placeholder="Enter Phone Number" value="{{ old('phone_no', $examfeepayment->phone_no) }}"
                            required="">
                        @error('phone_no')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="servicetype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Service Type</label>
                        <select id="servicetype" name="servicetype_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option disabled selected="">Choose Service Type</option>
                            @foreach ($servicetypes as $servicetype)
                                <option value="{{ $servicetype->id }}" data-fee="{{ $servicetype->fee }}"
                                    data-currency="{{ $servicetype->exchangeRate->code }}"
                                    data-rate="{{ $servicetype->exchangeRate->rate }}"
                                    @if ($examfeepayment->servicetype_id == $servicetype->id) selected @endif>
                                    {{ $servicetype->name }} ({{ $servicetype->fee }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 my-5">

                    <hr class="sm:col-span-2 border-2 border-gray-300">


                    <h3 class="sm:col-span-2 text-black font-bold text-xl">Payment</h3>

                    <div class="w-full">
                        <label for="payment_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Payment Type</label>
                        <select id="payment_type" name="payment_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option disabled selected="">Choose Payment Type</option>
                            <option value="Cash"
                                {{ (old('payment_type') ?? $examfeepayment->payment_type) == 'Cash' ? 'selected' : '' }}>
                                Cash
                            </option>
                            <option value="Bank"
                                {{ (old('payment_type') ?? $examfeepayment->payment_type) == 'Bank' ? 'selected' : '' }}>
                                Bank
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-wrap -mx-2">
                        <div class="w-full md:w-1/2 px-2">
                            <label for="bank_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bank
                                Name</label>
                            <input type="text" name="bank_name" id="bank_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter Bank Name" value="{{ old('bank_name', $examfeepayment->bank_name) }}">
                        </div>

                        <div class="w-full md:w-1/2 px-2">
                            <label for="currency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Currency</label>
                            <select id="currency" name="currency"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option disabled selected>Choose Currency</option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency }}"
                                        {{ (old('currency') ?? $examfeepayment->currency) == $currency ? 'selected' : '' }}>
                                        {{ $currency }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="w-full">
                        <label for="total_fee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total
                            Fee(US)
                        </label>
                        <input type="number" name="total_fee" id="total_fee"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Total Fee" value="{{ old('total_fee', $examfeepayment->total_fee) }}" readonly>
                    </div>

                    <div class="w-full">
                        <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total(Ks)

                        </label>
                        <input type="number" name="total" id="total"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Total" value="{{ old('total', $examfeepayment->total) }}" readonly>
                    </div>

                    <div class="w-full">
                        <label for="payment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment
                        </label>
                        <input type="number" name="payment" id="payment"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('payment') border-red-500 @enderror"
                            placeholder="Enter Payment" value="{{ old('payment', $examfeepayment->payment) }}"
                            required="">
                        @error('payment')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="refund" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Refund
                        </label>
                        <input type="number" name="refund" id="refund"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('refund') border-red-500 @enderror"
                            placeholder="Enter Refund" value="{{ old('refund', $examfeepayment->refund) }}">

                    </div>

                    <div class="sm:col-span-2">
                        <label for="remark" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student
                            Name</label>
                        <textarea type="text" name="remark" id="remark" cols="30"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Enter Remark">{{ old('remark', $examfeepayment->remark) }}</textarea>

                    </div>
                </div>

                <div class="grid justify-items-end">
                    <div class="flex space-x-2">

                        <button type="submit"
                            class="btn text-white bg-[#002D74] my-3 btn-sm hover:bg-[#001F56]">Update</button>
                    </div>

                </div>
            </form>
        </div>



    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceTypeSelect = document.getElementById('servicetype');
            const paymentInput = document.getElementById('payment');
            const refundInput = document.getElementById('refund');
            const totalFeeInput = document.getElementById('total_fee');
            const totalInput = document.getElementById('total');

            function updateFeeAndRefund() {
                const selectedOption = serviceTypeSelect.options[serviceTypeSelect.selectedIndex];
                const fee = parseFloat(selectedOption.getAttribute('data-fee')) || 0;
                const rate = parseFloat(selectedOption.getAttribute('data-rate')) || 1;
                const total = fee * rate;

                totalFeeInput.value = fee;
                totalInput.value = total;
                updateRefund();
            }

            function updateRefund() {
                const payment = parseFloat(paymentInput.value) || 0;
                const total = parseFloat(totalInput.value) || 0;
                const refund = payment - total;
                refundInput.value = refund;
            }

            serviceTypeSelect.addEventListener('change', updateFeeAndRefund);
            paymentInput.addEventListener('input', updateRefund);

            // Trigger initial calculation on page load
            updateFeeAndRefund();
        });
    </script>
@endsection
