    <p>
        <label for="user_name">Nom</label>
        <select name="user_sex" id="user_sex">
            <option value="m">Mr.</option>
            <option value="f">Mrs.</option>
        </select>
        <input type="text" name="user_name" id="user_name" value="{{user.name}}" />
    </p>
    <p>
        <label for="user_login_email">Couriel</label>
        <input type="text" name="user_login_email" id="user_login_email" value="{{user.login_email}}" />
    </p>
    <p>
        <label for="user_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="user_tel1" id="user_tel1" value="{{user.tel1}}" />
    </p>
    <p>
        <label for="user_tel2">Cellulaire</label>
        <input type="text" name="user_tel2" id="user_tel2" value="{{user.tel2}}" />
    </p>
    <p>
        <label for="user_address">Addresse</label>
        <textarea name="user_address" id="user_address" >{{user.address}}</textarea>
    </p>
