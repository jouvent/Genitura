<table class="listing">
<tr align="left">
<th>Nom</th>
<th>Courriel</th>
<th>T&eacute;l&eacute;phone</th>
<th>Cellulaire</th>
<th>Titre</th>
<th>Groupe</th>
<th>Bus</th>
</tr>
{% for user in users %}
    <tr class="{{user.type|slug_title}}">
        <td><a href="/user/page/{{user.id}}">{{ user.name }}</a></td>
        <td><a href="/email/user/{{user.id}}">{{user.login_email}}</a></td>
        <td>&nbsp;{{user.tel1}}</td>
        <td>&nbsp;{{user.tel2}}</td>
        <td>{{user.type|title|safe}} - {{user.invite_status|status|safe}}</td>
        <td><a href="/group/{{user.Group.id}}">{{user.Group.name}}</a></td>
        <td><a href="/bus/{{user.Bus.bus_id}}">{{user.Bus.name}}</a></td>
    </tr>
{% endfor %}
</table>
