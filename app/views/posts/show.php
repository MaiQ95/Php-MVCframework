<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="mb-4">
  <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light" role="button">Back</a>
</div>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>
<p><?php echo $data['post']->body; ?></p>

<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
  <hr>
  <div class="row mb-3">
    <div class="col-6">
  <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark" role="button">Edit</a>
    </div>

  <div class="col-6 text-center">
    <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
      <input type="submit" name="Delete" value="Delete" class="btn btn-danger">
    </form>
  </div>
</div>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
