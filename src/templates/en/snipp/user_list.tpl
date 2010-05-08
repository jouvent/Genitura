<table class="listing">
<tr align="left">
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Cell</th>
<th>Title</th>
<th>Group</th>
<th>Bus</th>
<th>Status</th>
</tr>
{% for user in users %}
    <tr class="{{user.type|slug_title}}">
        <td><a href="/user/page/{{user.id}}">{{ user.name }}</a></td>
        <td><a href="/email/user/{{user.id}}">{{user.login_email}}</a></td>
        <td>&nbsp;{{user.tel1}}</td>
        <td>&nbsp;{{user.tel2}}</td>
        <td>{{user.type|title|safe}}</td>
        <td><a href="/group/{{user.Group.id}}">{{user.Group.name}}</a></td>
        <td><a href="/bus/{{user.Bus.bus_id}}">{{user.Bus.name}}</a></td>
        <td>{{user.invite_status|status|safe}}</td>
    </tr>
{% endfor %}
</table>
