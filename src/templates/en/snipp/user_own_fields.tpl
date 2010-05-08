   <p>
        <label for="user_name">Name</label>
		 {% if user.sex == 'm' %} Mr. {% endif %}
         {% if user.sex == 'f' %} Mrs. {% endif %}
		 {{user.name}}
    </p>
    <p>
        <label for="user_login_email">Email</label>
        {{user.login_email}}
    </p>
    <p>
        <label for="user_tel1">Phone</label>
        <input type="text" name="tel1" id="tel1" value="{{user.tel1}}" />
    </p>
    <p>
        <label for="user_tel2">Cell</label>
        <input type="text" name="tel2" id="tel2" value="{{user.tel2}}" />
    </p>
    <p>
        <label for="user_address">Address</label>
        <textarea name="address" id="address" >{{user.address}}</textarea>
    </p>
{% if logged.type == 'A' %}
<p>
    <label for="user_invite_quotas">invitations available for this person</label>
    <input type="text" name="invite_quotas" id="invite_quotas" value="{{user.invite_quotas}}" />
</p>
{% endif %}

