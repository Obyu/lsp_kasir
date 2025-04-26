import './bootstrap';
import {Chart} from 'chart.js';
window.Chart = Chart;
import $, { ajax, data } from "jquery";
$(document).ready(function () {
    $('#search').on('keyup', function () {
        let keyword = $(this).val();

        if (keyword.length > 0){
        $.ajax({
            url: "/dashboard/search",
            type: "GET",
            data: {keyword: keyword},
            success: function(data){
                let resulthtml = "";
                if (data.length > 0){
                    data.forEach(item => {
                        resulthtml += `<p class="cursor-pointer hover:bg-gray-200 p-2" data-id="${item.idpelanggan}">${item.Namapelanggan} ${item.idpelanggan}</p>`;
                    });
                } else {
                    resulthtml = "<p>tidak ada hasil</p>";
                }
                $('#searchResults').html(resulthtml);
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    }
    });
    $(document).on('click', '#searchResults p', function () {
        let selectid = $(this).data('id');
        $('#idpelanggan').val(selectid);
        $.ajax({
            url: "/transaction/result-search",
            type: "GET",
            data: {idpelanggan: selectid},
            success: function (data) {
                console.log("Response dari backend:", data);
                let transaction = "";
                if (data.length > 0){
                    data.forEach((item, index) => {
                        transaction += `<tr class="bg-white border-b border-gray-50 dark:bg-zinc-700 dark:border-zinc-600">
                    <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap dark:text-zinc-100">
                        ${index + 1}
                    </th>
                    <td class="px-6 py-3.5 dark:text-zinc-100">
                        ${item.Namapelanggan}
                    </td>
                    <td class="px-6 py-3.5 dark:text-zinc-100">
                        <a href="/transaction/create/${item.idpelanggan}" class="btn">Bayar</a>
                    </td>
                </tr>`
                    });
                } else {
                    transaction = "<tr><td colspan='3'>Tidak ada transaksi</td></tr>";
                }
                $('#transaksitable tbody').html(transaction);
            },
            error: function(xhr) {
                console.error("error: ", xhr.responseText);
            }
        });
    });
});
