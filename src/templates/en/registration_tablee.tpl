{% extends 'registration_base.tpl' %}

{% block form %}
    {% include 'snipp/message.tpl' %}

    {% if errors.user.sex.homosexual_couple %}
    <label for="user_name" class="error">
    Each table must have a man and a woman.
    </label>
    {% endif %}
    <form action="" method="post" name="registration_userinfo" >
    <h3>Please entre your contact informations</h3>

        {% include 'snipp/user_fields.tpl' %}

            <p><label align="right">Password</label>
                <input type="password" id="password" name="password" size="25"></p>
                {% if errors.user.password.valid %}
                <label for="user_name" class="error">
                Invalid password.
                </label>
                {% endif %}

            <p><label align="right">Confirmation</label>
                <input type="password" id="confirmpassword" name="confirmpassword" size="25"></p>
    <h3>who will sit with you ?</h3>
    <p>
        <label for="couple_name">Name</label>
        <select name="couple_sex" id="couple_sex">
            <option value="m" {% if couple.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if couple.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="couple_name" id="couple_name" value="{{couple.name}}" />
        {% if errors.user.couple.notblank %}
        <label for="user_name" class="error">
            You must enter a Name (format: Firstname, Lastname).
        </label>
        {% endif %}
    </p>
    <p>
        <label for="couple_login_email">Email</label>
        <input type="text" name="couple_login_email" id="couple_login_email" value="{{couple.login_email}}" />
        {% if errors.couple.login_email.email %}
        <label for="user_name" class="error">
            Please enter a valid email.
        </label>
        {% endif %}
        {% if errors.couple.login_email.unique %}
        <label for="user_name" class="error">
            This email is already registered in the database.
        </label>
        {% endif %}
    </p>
    <p>
        <label for="couple_tel1">Telephone</label>
        <input type="text" name="couple_tel1" id="couple_tel1" value="{{couple.tel1}}" />
    </p>
    <p>
        <label for="couple_tel2">Cellphone</label>
        <input type="text" name="couple_tel2" id="couple_tel2" value="{{couple.tel2}}" />
    </p>
    <p>
        <label for="couple_address">Address</label>
        <textarea name="couple_address" id="couple_address" >{{couple.address}}</textarea>
    </p>

    <p><label><input type="submit" name="submit" value="Send"></label></p>

    </form>
{% endblock %}
