<!-- MyVendor\search\src\resources\views\index.blade.php -->
<?php
$has_records = isset($items) && is_array($items) && count($items);
$can_delete = true;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Google Custom Search (Mawdoo3)</title>
    </head>
    <body>
        <div style="margin-top: 90px;" class="col-lg-12 col-md-12">
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <h3>Google Custom Search (Mawdoo3) <a class="btn btn-success float-right" href="{{url('search/all_results')}}"/>search results</a></h3>
            
            <form action="{{url('search')}}" method="GET">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="q" id="q" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>" placeholder="key">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <br/>
            <br/>
            @if(isset($_GET['q']))
            <form action="{{url('search/results_save')}}" method="post" accept-charset="utf-8">
                @csrf
                <input type="hidden" name="results" value="{{$results}}"/>
                <table class='table table-striped table-condensed table-hover managed_table'>
                     <!--<thead>
                    <tr>
                        <th class="sorting">title</th>
                        <th>description</th>
                        <th>link</th>
                        <th>comment</th>
                        <th>operations</th>
                    </tr>
                </thead>
                -->
                    <?php if ($has_records) : ?>
                        <tfoot>
                            <?php if ($can_delete) : ?>
                                <tr>
                                    <td colspan='4'>
                                        <?php //echo lang('bf_with_selected'); ?>
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
                            foreach ($items as $key => $item) :
                                ?>
                                <tr>
                                    <?php if ($can_delete) : ?>
                                        <td><input type='checkbox' class="checkboxes" name='checked[]' value='<?php echo $key; ?>' /></td>
                                        <?php endif; ?>
                                    <td><?php echo $item->title; ?></td>
                                    <td><?php echo $item->snippet; ?></td>
                                    <td><?php echo $item->link; ?></td>
                                    <td>
                                        <textarea name="comment_{{$key}}"></textarea>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            ?>
                            <tr>
                                <td colspan='4'>no records</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </form>
            @endif
        </div>
    </body>
</html>