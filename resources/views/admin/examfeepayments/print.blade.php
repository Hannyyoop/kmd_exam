<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ExamFee Payment Receipt</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container mx-auto px-12 py-4 landscape my-auto" id="printArea">
        <div class="overflow-x-auto pb-2 pt-2 printarea">
            <table class="table">
                <tr>
                    <td class="border-2 border-blue-400">
                        <div class="w-20">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9XcBnanyQE_-9rq5WeTU5598nSdClHdB9YS1Evh9dDA&s"
                                alt="KMD">
                        </div>
                    </td>
                    <td class="border-2 border-blue-400">
                        <p class="text-2xl font-bold">KMD Computer Center</p>
                    </td>
                    <td class="border-2 border-blue-400">
                        <p>Issue Date: {{ $examfeepayment->date }}</p>
                        <p>Start Date: {{ $examfeepayment->exam_date }}</p>
                    </td>
                    <td class="border-2 border-blue-400">
                        <p>Info/Re/034</p>
                        <p>Issue: 1.0</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="border-2 border-blue-400 text-black">331, Pyay Road, Myaynigone, Sanchaung
                        Township
                        <span class="text-black">Email: info@kmdcomputer.com</span>
                    </td>
                    <td class="border-2 border-blue-400">Page 1 of 1</td>
                </tr>
            </table>
        </div>

        <div class="text-center font-bold mb-5 text-xl">
            Exam Fee Receipt
        </div>

        <div class="grid grid-cols-2 gap-y-3">
            <div class="grid grid-cols-3">
                <div class="text-black font-semibold">Recepit From: </div>
                <div class="col-span-2">{{ $examfeepayment->user->name }}</div>
            </div>
            <div class="grid grid-cols-3">
                <div class="text-black font-semibold">Center: </div>
                <div>{{ $examfeepayment->center->name }}</div>
            </div>
            <div class="grid grid-cols-3">
                <div class="text-black font-semibold">Service Type: </div>
                <div>{{ $examfeepayment->serviceType->name }}</div>
            </div>
            <div class="grid grid-cols-3">
                <div class="text-black font-semibold">Exam Date: </div>
                <div>{{ \Carbon\Carbon::parse($examfeepayment->exam_date)->format('d/M/Y') }}</div>
            </div>
            <div class="grid grid-cols-3">
                <div class="text-black font-semibold">Payment Type: </div>
                <div>{{ $examfeepayment->payment_type }}</div>
            </div>
            <div class="grid grid-cols-3">
                <div class="text-black font-semibold">Bank Name: </div>
                <div>{{ $examfeepayment->bank_name }}</div>
            </div>
            <div class="font-bold grid grid-cols-3">
                <div class="text-black font-semibold">Voucher No: </div>
                <div>{{ $examfeepayment->voucher_no }}</div>
            </div>
            <div class="grid grid-cols-3">
                <div class="text-black font-semibold">Payment Date: </div>
                <div>{{ $examfeepayment->exam_date }}</div>
            </div>
            <div class="grid grid-cols-3">
                <div class="text-black font-semibold">Fees: </div>
                <div>{{ $examfeepayment->total_fee * $examfeepayment->serviceType->exchangeRate->rate }} (MMK)</div>
            </div>
            <div class="grid grid-cols-3">
                <div class="text-black font-semibold">Total Amount: </div>
                <div>{{ $examfeepayment->total }} (MMK)</div>
            </div>
            <div class="grid grid-cols-3">
                <div class="text-black font-semibold">Remark: </div>
                <div>{{ $examfeepayment->remark }}</div>
            </div>
        </div>


        <div class="flex justify-end pb-10">
            {{-- <div class="font-bold">Note: Cash No Refund</div> --}}
            <div class="text-center">
                <div>--------------------</div>
                <div>Received By</div>
            </div>
        </div>

        <div class="overflow-x-auto mb-3">
            <table class="table">
                <tr class="text-center">
                    <td class="border-2 border-blue-400 text-black">
                        <div class="text-xs">Pansodan: 09262600450, Myaynigone: 09889491136/98428055067, UDE:
                            501243/09262600301</div>
                        <div class="text-xs">Hledan: 09402171227, Tarmwe: 0976776004/54660070</div>
                    </td>
                    {{-- <td class="border border-blue-400">
                        <div class="text-xs">
                            -သင်တန်းစဖွင့်သည့်နေ့တွင်(၁၅)မိနစ်စောလာပေးပါရန်။
                        </div>
                        <div class="text-xs">
                            -နောက်ကျမည်ဆိုပါကဖုန်းဆက်အကြောင်းကြားရန်။
                        </div>
                    </td> --}}
                </tr>
            </table>
        </div>
        <div class="flex justify-center space-x-2 non-print">
            <a href="{{ route('examfeepayments.index') }}"
                class="btn my-3 btn-secondary px-10 text-md bg-gray-300 text-gray-800 hover:bg-gray-200 hover:text-gray-900 border border-black hover:border-black ">Back</a>

            <button type="submit" onclick="print()"
                class="btn text-white bg-[#002D74] my-3 px-10 text-md hover:bg-[#001F56]">Print</button>
        </div>

    </div>

    <script>
        const print = () => {
            window.print();
        }
    </script>
    <style media="print" rel="stylesheet" scoped>
        @page {
            margin: 0;
            size: A5 landscape;
        }

        @media print {
            #printArea {
                display: block;
                font-size: smaller;
            }

            .non-print {
                display: none;
            }

            .printarea {
                width: 100%;
                border: none;
            }

            .landscape {
                width: 210mm;
                height: 148mm;
            }

            .table,
            .grid {
                width: 100%;
            }
        }
    </style>
</body>

</html>
