    <p>
        <label for="friend_2_name">Name</label>
        <select name="friend_2_sex" id="friend_2_sex">
            <option value="m" {% if friend_2.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friend_2.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friend_2_name" id="friend_2_name" value="{{friend_2.name}}" />
        {% if errors.friend_2.name.notblank %}
        <label for="friend_2_name" class="error">
            You must enter a name (format: Firstname, Lastname).
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_2_login_email">Email</label>
        <input type="text" name="friend_2_login_email" id="friend_2_login_email" value="{{friend_2.login_email}}" />
        {% if errors.friend_2.login_email.email %}
        <label for="friend_2_name" class="error">
            Please enter a valid email.
        </label>
        {% endif %}
        {% if errors.friend_2.login_email.unique %}
        <label for="friend_2_name" class="error">
            This email is already registered in the database.
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_2_tel1">Phone</label>
        <input type="text" name="friend_2_tel1" id="friend_2_tel1" value="{{friend_2.tel1}}" />
    </p>
    <p>
        <label for="friend_2_tel2">Cell</label>
        <input type="text" name="friend_2_tel2" id="friend_2_tel2" value="{{friend_2.tel2}}" />
    </p>
    <p>
        <label for="friend_2_address">Address</label>
        <textarea name="friend_2_address" id="friend_2_address" >{{friend_2.address}}</textarea>
    </p>
{% if logged.type == 'A' %}
<p>
    <label for="friend_2_invite_quotas">invitations available for this person</label>
    <input type="text" name="friend_2_invite_quotas" id="friend_2_invite_quotas" value="{{friend_2.invite_quotas}}" />
</p>
{% endif %}