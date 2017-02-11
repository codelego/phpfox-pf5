<form method="post">
                <div class="form-group">
                    <label>Input</label>
                    <textarea class="form-control" rows="5"
                              onclick="this.select()"
                              name="json"><?= @$_REQUEST['json'] ?></textarea>
</div>
<div class="form-group">
    <label>Output</label>
    <textarea name="result" onclick="this.select()" rows="5"
              class="form-control"><?= $result ?></textarea>
</div>
<div class="form-group">
    <div class="checkbox">
        <label><input type="checkbox" name="shorten"
                      value="1" <?php if ($shorten) echo 'checked' ?>>Shorten
            data</label>
    </div>
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">Convert
    </button>
    <a href="?" class="btn btn-info">Reset</a>
</div>
</form>