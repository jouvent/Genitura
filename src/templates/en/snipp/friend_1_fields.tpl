    <p>
        <label for="friend_1_name">Name</label>
        <select name="friend_1_sex" id="friend_1_sex">
            <option value="m" {% if friend_1.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friend_1.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friend_1_name" id="friend_1_name" value="{{friend_1.name}}" />
        {% if errors.friend_1.name.notblank %}
        <label for="friend_1_name" class="error">
            You must enter a name (format: Firstname, Lastname).
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_1_login_email">Email</label>
        <input type="text" name="friend_1_login_email" id="friend_1_login_email" value="{{friend_1.login_email}}" />
        {% if errors.friend_1.login_email.email %}
        <label for="friend_1_name" class="error">
            Please enter a valid email.
        </label>
        {% endif %}
        {% if errors.friend_1.login_email.unique %}
        <label for="friend_1_name" class="error">
            This email is already registered in the database.
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_1_tel1">Phone</label>
        <input type="text" name="friend_1_tel1" id="friend_1_tel1" value="{{friend_1.tel1}}" />
    </p>
    <p>
        <label for="friend_1_tel2">Cell</label>
        <input type="text" name="friend_1_tel2" id="friend_1_tel2" value="{{friend_1.tel2}}" />
    </p>
    <p>
        <label for="friend_1_address">Address</label>
        <textarea name="friend_1_address" id="friend_1_address" >{{friend_1.address}}</textarea>
    </p>
{% if logged.type == 'A' %}
<p>
    <label for="friend_1_invite_quotas">invitations available for this person</label>
    <input type="text" name="friend_1_invite_quotas" id="friend_1_invite_quotas" value="{{friend_1.invite_quotas}}" />
</p>
{% endif %}