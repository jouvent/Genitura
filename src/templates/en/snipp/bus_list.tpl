<table class="listing">
    <tr>
        <td>Bus</td>
        <td>Bus Chief</td>
        <td>&nbsp;</td>
        <td>Guest nb.</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
{% for bus in buses %}
    <tr>
        <td><a href="/bus/{{bus.bus_id}}">{{ bus.name }}</a></td>
        <td><a href="/bus/{{bus.bus_id}}">{{bus.Chief.name}}</a></td>
        <td><a href="/email/user/{{bus.Chief.id}}"><img class="action_img" src="/media/img/email.jpg" /></a></td>
        <td>{{bus.nb_users}} / 50</td>
        <td><a href="/user/bus/{{bus.bus_id}}">Guest</a></td>
        <td><a href="/inviter/bus/{{bus.bus_id}}">New Invitations</a></td>
        <td><a href="/bus/edit/{{bus.bus_id}}">Edit</a></td>
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

