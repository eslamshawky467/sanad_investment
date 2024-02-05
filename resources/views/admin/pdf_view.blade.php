<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="invoice.css"></head>
<body style="padding: 3rem">
                <div class="text-center">
<img src="{{asset('images/sanad logo 2-05.png')}}"style="width:100opx;height:100px"  alt="IMG">
</div>
    <h1>Report Sanad</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Users</th>
                <th>Accounts</th>
                <th>Money of Account Sanad</th>
                <th>
Money Of Investment</th>
                <th>Money Stored in Sanad</th>
                  <th>Remain Units</th>
                <th>All Units</th>
                <th>Invested Units</th>
                
            </tr>
        </thead>
        <tr>
            <tbody>
            <td>{{\App\Models\Client::count()}}</td>
            <td>{{\App\Models\Account::count()}}</td>
            <td class="text-end">{{$money}}</td>
            <td class="text-end">{{$onhold}}</td>
            <td class="text-end">{{$balanced}}</td>
            
            <td class="text-end">{{$remain}}</td>
            <td class="text-end">{{$total}}</td>
            <td class="text-end">{{$inv}}</td>
        
        </tbody>
        </tr>
    </table>
</body>
</html>