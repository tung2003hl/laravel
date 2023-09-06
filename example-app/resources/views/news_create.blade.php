<form method="post" action="/admin/news/store">
    @method('PATCH')
    @csrf
    <p>
        <label for="title">Title</label><br>
        <input type="text" name="title" value="">
    </p>

    <p>
        <label for="email">Email</label><br>
        <input type="text" name="email" value="">
    </p>

    <p>
        <label for="description">Description</label><br>
        <textarea cols="20" rows="10" name="description"></textarea>
    </p>

    <p>
        <button type="submit">Submit</button>
    </p>
</form>