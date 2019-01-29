<!-- MyVendor\search\src\resources\views\index.blade.php -->
<?php
$has_records = isset($records[0]->title);
$can_delete = true;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Google Custom Search (Mawdoo3)</title>
    </head>
    <body>
        <div style="margin-top: 90px;" class="col-lg-12 col-md-12">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <h3> Search result page (Mawdoo3) <a class="btn btn-success float-right" href="{{url('search')}}"/>search</a></h3>
            <table class='table table-bordered table-striped table-condensed table-hover managed_table'>
                <thead>
                    <tr>
                        <th class="sorting">title</th>
                        <th>description</th>
                        <th>link</th>
                        <th>comment</th>
                        <th>operations</th>
                    </tr>
                </thead>
                <?php if ($has_records) : ?>
                    <tfoot>
                        <?php if ($can_delete) : ?>
                            <tr>
                                <td colspan='4'>
                                    <?php //echo lang('bf_with_selected');  ?>
                                    <button type="submit" name="save" id="save" class='btn btn-primary' >
                                        save
                                    </button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tfoot>
                <?php endif; ?>
                <tbody>
                    <?php
                    if ($has_records) :
                        foreach ($records as $item) :
                            $id = $item->id;
                            ?>
                            <tr class="myrow">
                                <td><?php echo $item->title; ?></td>
                                <td><?php echo $item->description; ?></td>
                                <td><?php echo $item->link; ?></td>
                                <td>
                                    <p  class="comment-txt"><?php echo $item->comment; ?></p>
                                    <form class="edit-form" action="{{url('search/edit/'.$item->id)}}" method="post" hidden>
                                        @csrf
                                        <textarea name="comment" ><?php echo $item->comment; ?></textarea>
                                        <button name="edit" class="btn btn-info btn-sm" >edit</button>
                                        <a class="btn btn-danger btn-sm cancel" href="#"/>cancel</a>
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm edit_search" href="#"/>edit</a>
                                    <form action="{{url('search/delete/'.$item->id)}}" method="post">
                                        @csrf
                                        <button name="delete" class="btn btn-info btn-sm" >delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    else:
                        ?>
                        <tr>
                            <td colspan='5'>no records</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <script>
$(document).ready(function () {

    $('body').on('click', '.edit_search', function () {
        $('form.edit-form').attr('hidden', 'hidden');
        $('.comment-txt').removeAttr('hidden');
        $(this).parents('tr.myrow').find('form.edit-form').removeAttr('hidden');
        $(this).parents('tr.myrow').find('.comment-txt').attr('hidden', 'hidden');
    });
    
    $('body').on('click', '.cancel', function () {
        $('form.edit-form').attr('hidden', 'hidden');
        $('.comment-txt').removeAttr('hidden');
    });

});
        </script>
    </body>
</html>