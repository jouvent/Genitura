<table class="listing">
    <tr>
        <td>Groupe</td>
        <td>Chef de Groupe</td>
        <td>&nbsp;</td>
        <td>Nb. de Bus</td>
        <td>Nb. Invit&eacute;s</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
{% for group in groups %}
    <tr>
        <td><a href="/group/{{group.id}}">{{ group.name }}</a></td>
        <td><a href="/group/{{group.id}}">{{group.Chief.name}}</a></td>
        <td><a href="/email/user/{{group.Chief.id}}"><img class="action_img" src="/media/img/email.jpg" /></a></td>
        <td>{{group.nb_buses}}</td>
        <td>{{group.nb_users}} / {{group.size}}</td>
        <td><a href="/user/group/{{group.id}}">Invites</a></td>
        <td><a href="/invitation/csv">Nouvelles Invitations</a></td>
        <td><a href="/group/edit/{{group.id}}">Editer</a></td>
    </tr>
{% endfor %}
    <tr>
        <td>Total</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>{{group_summary.nb_buses}}</td>
        <td>{{group_summary.nb_users}} / {{group_summary.sum_size}}</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>
