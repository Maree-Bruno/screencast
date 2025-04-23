@component('layouts.app')
    <h1>Dashboard</h1>
    <table>
        <tr>
            <th>Date de la perte</th>
            <th>Nom de l'animal</th>
            <th>Nom du propriétaire</th>
        </tr>
        @foreach($losses as $loss)
            <tr>
                <td>{{$loss->lost_at->toDayDateTimeString()}}</td>
                <td><a href="/loss-declaration/show?id={{$loss->id}}">{{$loss->pet->name}}</a></td>
                <td>{{$loss->pet_owner->name}}</td>
            </tr>
        @endforeach
    </table>
@endcomponent
