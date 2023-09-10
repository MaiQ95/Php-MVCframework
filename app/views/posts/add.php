<?php require APPROOT . '/views/inc/header.php'; ?>

        <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light" role="button">Back</a>
        <div class="card card-body mt-4">
          <?php flash('register_success'); ?>
          <h2>Add post</h2>
          <p>Create a post with this form</p>
          <form action="<?php echo URLROOT; ?>/posts/add" method="post">
            <div class="form-group">
              <label for="email">Title:</label>
              <input type="text" name="title" class="form-control form-control -lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
              <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
            </div>
            <div class="form-group">
              <label for="body">Body:</label>
              <textarea name="body" class="form-control form-control -lg mb-3 <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
              <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
            </div>
            <input type="submit" class="btn btn-success" value="submit">
          </form>
        </div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
