    <p>
        <label for="in_couple_name">Name</label>
        <select name="in_couple_sex" id="in_couple_sex">
            <option value="m" {% if in_couple.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if in_couple.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="in_couple_name" id="in_couple_name" value="{{in_couple.name}}" />
        {% if errors.in_couple.name.notblank %}
        <label for="in_couple_name" class="error">
            You must enter a name (format: Firstname, Lastname).
        </label>
        {% endif %}
    </p>
    <p>
        <label for="in_couple_login_email">Email</label>
        <input type="text" name="in_couple_login_email" id="in_couple_login_email" value="{{in_couple.login_email}}" />
        {% if errors.in_couple.login_email.email %}
        <label for="in_couple_name" class="error">
            Please enter a valid email.
        </label>
        {% endif %}
        {% if errors.in_couple.login_email.unique %}
        <label for="in_couple_name" class="error">
            This email is already registered in the database.
        </label>
        {% endif %}
    </p>
    <p>
        <label for="in_couple_tel1">Phone</label>
        <input type="text" name="in_couple_tel1" id="in_couple_tel1" value="{{in_couple.tel1}}" />
    </p>
    <p>
        <label for="in_couple_tel2">Cell</label>
        <input type="text" name="in_couple_tel2" id="in_couple_tel2" value="{{in_couple.tel2}}" />
    </p>
    <p>
        <label for="in_couple_address">Address</label>
        <textarea name="in_couple_address" id="in_couple_address" >{{in_couple.address}}</textarea>
    </p>
{% if logged.type == 'A' %}
<p>
    <label for="in_couple_invite_quotas">invitations available for this person</label>
    <input type="text" name="in_couple_invite_quotas" id="in_couple_invite_quotas" value="{{in_couple.invite_quotas}}" />
</p>
{% endif %}