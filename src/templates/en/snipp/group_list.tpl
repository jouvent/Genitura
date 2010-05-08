<table class="listing">
    <tr>
        <td>Group</td>
        <td>Group Chief</td>
        <td>&nbsp;</td>
        <td>Bus nb.</td>
        <td>Guests nb.</td>
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
        <td><a href="/user/group/{{group.id}}">Guests</a></td>
        <td><a href="/o/admin/upload_csv.php">New Invitations</a></td>
        <td><a href="/group/edit/{{group.id}}">Edit</a></td>
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
