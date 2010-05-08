{% extends 'registration_base.tpl' %}

{% block form %}
    {% include 'snipp/message.tpl' %}

    {% if errors.user.sex.homosexual_couple %}
    <label for="user_name" class="error">
    Each table must have a man and a woman.
    </label>
    {% endif %}
    <form action="" method="post" name="registration_userinfo" >
    <p>
        <input type="checkbox" name="friends" id="friends" value="yes" {% if friends %} checked="checked" {% endif %}/><label for="friends">I want to invate another table</label>
    </p>
    <h3>First person at the second table</h3>
    <p>
        <label for="friend_1_name">Name</label>
        <select name="friend_1_sex" id="friend_1_sex">
            <option value="m" {% if friend_1.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friend_1.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friend_1_name" id="friend_1_name" value="{{friend_1.name}}" />
        {% if errors.friend_1.couple.notblank %}
        <label for="user_name" class="error">
            You must enter a Name (format: Firstname, Lastname).
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_1_login_email">Couriel</label>
        <input type="text" name="friend_1_login_email" id="friend_1_login_email" value="{{friend_1.login_email}}" />
        {% if errors.friend_1.login_email.email %}
        <label for="user_name" class="error">
            Please enter a valid email.
        </label>
        {% endif %}
        {% if errors.friend_1.login_email.unique %}
        <label for="user_name" class="error">
            This email is already registered in the database.
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_1_tel1">Telephone</label>
        <input type="text" name="friend_1_tel1" id="friend_1_tel1" value="{{friend_1.tel1}}" />
    </p>
    <p>
        <label for="friend_1_tel2">Cell phone</label>
        <input type="text" name="friend_1_tel2" id="friend_1_tel2" value="{{friend_1.tel2}}" />
    </p>
    <p>
        <label for="friend_1_address">Address</label>
        <textarea name="friend_1_address" id="friend_1_address" >{{friend_1.address}}</textarea>
    </p>

    <h3>Please enter the information for the second person at the second table</h3>
    <p>
        <label for="friend_2_name">Name</label>
        <select name="friend_2_sex" id="friend_2_sex">
            <option value="m" {% if friend_2.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friend_2.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friend_2_name" id="friend_2_name" value="{{friend_2.name}}" />
        {% if errors.friend_2.couple.notblank %}
        <label for="user_name" class="error">
            You must enter a Name (format: Firstname, Lastname).
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_2_login_email">Email</label>
        <input type="text" name="friend_2_login_email" id="friend_2_login_email" value="{{friend_2.login_email}}" />
        {% if errors.friend_2.login_email.email %}
        <label for="user_name" class="error">
            Please enter a valid email.
        </label>
        {% endif %}
        {% if errors.friend_2.login_email.unique %}
        <label for="user_name" class="error">
            This email is already registered in the database.
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_2_tel1">Telephone</label>
        <input type="text" name="friend_2_tel1" id="friend_2_tel1" value="{{friend_2.tel1}}" />
    </p>
    <p>
        <label for="friend_2_tel2">Cellphone</label>
        <input type="text" name="friend_2_tel2" id="friend_2_tel2" value="{{friend_2.tel2}}" />
    </p>
    <p>
        <label for="friend_2_address">Address</label>
        <textarea name="friend_2_address" id="friend_2_address" >{{friend_2.address}}</textarea>
    </p>

    <p><label><input type="submit" name="submit" value="Send"></label></p>

    </form>
{% endblock %}
