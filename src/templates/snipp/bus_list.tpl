<table>
{% for bus in buses %}
    <tr>
        <td><a href="/bus/{{bus.id}}">{{ bus.name }}</a></td>
        <td><a href="/bus/{{bus.id}}">{{bus.Chief.name}}</a></td>
        <td><a href="/email/user/{{bus.Chief.id}}">Ecrire</a></td>
        <td>{{bus.nb_users}} / {{bus.size}}</td>
        <td><a href="/user/bus/{{bus.id}}">Invites</a></td>
        <td><a href="/inviter/bus/{{bus.id}}">Nouvelles Invitations</a></td>
        <td><a href="/bus/edit/{{bus.id}}">Editer</a></td>
    </tr>
{% endfor %}
    <tr>
        <td>Total</td>
        <td></td>
        <td></td>
        <td>{{bus_summary.nb_users}} / {{bus_summary.sum_size}}</td>
    </tr>
</table>
