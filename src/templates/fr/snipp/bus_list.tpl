<table class="listing">
    <tr>
        <td>Bus</td>
        <td>Chef de Bus</td>
        <td>&nbsp;</td>
        <td>Nb. Invit&eacute;s</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
{% for bus in buses %}
    <tr>
        <td><a href="/bus/{{bus.id}}">{{ bus.name }}</a></td>
        <td><a href="/bus/{{bus.id}}">{{bus.Chief.name}}</a></td>
        <td><a href="/email/user/{{bus.Chief.id}}"><img class="action_img" src="/media/img/email.jpg" /></a></td>
        <td>{{bus.nb_users}} / 50</td>
        <td><a href="/user/bus/{{bus.id}}">Invites</a></td>
        <td><a href="/inviter/bus/{{bus.id}}">Nouvelles Invitations</a></td>
        <td><a href="/bus/edit/{{bus.id}}">Editer</a></td>
    </tr>
{% endfor %}
    <tr>
        <td>Total</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>{{bus_summary.nb_users}} / {{bus_summary.sum_size}}</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>

