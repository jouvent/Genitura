<table class="listing">
{% for couple in couples %}
    <tr>
        <td>{{couple.select|safe}}</td>
        <td><a href="/user/page/{{couple.0.d__id}}">{{couple.0.d__name}}</a></td>
        <td><a href="/user/page/{{couple.1.d__id}}">{{couple.1.d__name}}</a></td>
        <td><a href="/email/tablee/{{couple.id}}"><img class="action_img" src="/media/img/email.jpg" /></a></td>
    </tr>
{% endfor %}
</table>
