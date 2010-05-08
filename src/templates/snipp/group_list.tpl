<table>
{% for group in groups %}
    <tr>
        <td><a href="/group/{{group.id}}">{{ group.name }}</a></td>
        <td><a href="/group/{{group.id}}">{{group.Chief.name}}</a></td>
        <td><a href="/email/user/{{group.Chief.id}}">Ecrire</a></td>
        <td>{{group.nb_buses}}</td>
        <td>{{group.nb_users}} / {{group.size}}</td>
        <td><a href="/user/group/{{group.id}}">Invites</a></td>
        <td><a href="/inviter/group/{{group.id}}">Nouvelles Invitations</a></td>
        <td><a href="/group/edit/{{group.id}}">Editer</a></td>
    </tr>
{% endfor %}
    <tr>
        <td>Total</td>
        <td></td>
        <td></td>
        <td>{{group_summary.nb_buses}}</td>
        <td>{{group_summary.nb_users}} / {{group_summary.sum_size}}</td>
    </tr>
</table>
