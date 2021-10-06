@extends('admin.layouts.tables')
@section('title', 'Receipt')
@section('viewpage')
<link rel="stylesheet" type="text/css" href="frontend/css/viewgrid.css">
<form action="{{ route('insertvprocesses') }}" method="POST" >
        <div class="content" id="contentdata" >
        <table class="table table-bordered">
            <tr style="background-color: ghostwhite;">
                <th colspan="4" style="text-align: center;">Receipt</th>
            </tr>
            <tr>
                <th style="background-color: ghostwhite;">Receipt No.</th>
                <td  id="lblcenter">{{ $data['vprocess']['id'] }}</td>
                <th style="background-color: ghostwhite;">Verified By </th>
                <td id="lbldate">
                    @php
                    $verifierrec = App\Models\User::where('id',$data['vprocess']['verifier_id'])->get();
                    @endphp 
                    {{ $verifierrec[0]['name'] }}
                </td>
            </tr>
            <tr>
                <th style="background-color: ghostwhite;">Center</th>
                <td  id="lblcenter">{{ $data['beneficiariesrec'][0]['address'] }}, {{ $data['beneficiariesrec'][0]['cvcname'] }}</td>
                <th style="background-color: ghostwhite;">Date:</th>
                <td id="lbldate">{{ $data['vprocess']['vaccinedate'] }}</td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr style="background-color: ghostwhite;">
                <th>Reference ID</th>      
                <th>Name</th>          
                <th>Vaccine Name</th>      
                <th>Dose Type</th>                    
            </tr>
            <tr>
                <td id="lblrefid">{{ $data['beneficiariesrec'][0]['referenceid'] }}</td>
                <td id="lblname">{{ $data['beneficiariesrec'][0]['name'] }}</td>
                <td id="lblvaccinename">{{ $data['beneficiariesrec'][0]['vname'] }}</td>
                <td id="lbldosetype">Dose No. {{ $data['beneficiariesrec'][0]['doseno'] }}</td>             
            </tr>
            </table>
            
            <table class="table table-bordered">
                <tr>
                    <th style="background-color: ghostwhite;">Paid Amount</th>      
                    <td id="amount_to_pay">₹ {{ $data['vprocess']['amount'] }}</td>                               
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th style="background-color: ghostwhite;text-align: left;width: 50%;">Verifier Signature</th>   
                    <th style="background-color: ghostwhite;text-align: right;width: 50%;">Vaccinator Signature</th>                              
                </tr>
                <tr>
                    <td style="height: 75px;"></td>   
                    <td style="height: 75px;"></td>                              
                </tr>
            </table>
        </div>
        <hr>
        <div class="content"  >
            <centeR><input type="button" name="btnverify" id="btnverify" value="Print Receipt" class="btn btn-warning btn-lg" onclick="print_receipt('contentdata')"></centeR>
        </div>
    </form>
<script>
function print_receipt(contentdata)
{
     var printContents = document.getElementById(contentdata).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
</script>
@endsection