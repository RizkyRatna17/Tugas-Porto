<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$blogDetail = mysqli_query($koneksi, "SELECT categories.name, blogs. * FROM blogs JOIN categories ON categories.id = blogs.id_category WHERE blogs.id = '$id'");

$rowBlogDetail = mysqli_fetch_assoc($blogDetail);

$recentBlog = mysqli_query($koneksi, "SELECT categories.name, blogs. * FROM blogs JOIN categories ON categories.id = blogs.id_category ORDER BY blogs.id DESC LIMIT 5");

$rowRecentBlog = mysqli_fetch_all($recentBlog, MYSQLI_ASSOC);
?>



<!-- Page Title -->
<div class="page-title accent-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Blog Details</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li class="current">Blog Details</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->

<div class="container">
    <div class="row">

        <div class="col-lg-8">

            <!-- Blog Details Section -->
            <section id="blog-details" class="blog-details section">
                <div class="container">

                    <article class="article">

                        <div class="post-img">
                            <img src="admin/uploads/<?php echo $rowBlogDetail['image'] ?>" alt="" class="img-fluid">
                        </div>

                        <h2 class="title"><?php echo $rowBlogDetail['title'] ?></h2>

                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                        href="blog-details.html"><time
                                            datetime="2020-01-01"><?php echo date("M d, Y", strtotime($rowBlogDetail['created_at'])) ?></time></a>
                                </li>
                                <!-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                        href="blog-details.html">12 Comments</a></li> -->
                            </ul>
                        </div><!-- End meta top -->

                        <div class="content">
                            <?php echo $rowBlogDetail['description'] ?>
                        </div><!-- End post content -->

                    </article>

                </div>
            </section><!-- /Blog Details Section -->



        </div>

        <div class="col-lg-4 sidebar">

            <div class="widgets-container">
                <!-- Search Widget -->
                <div class="search-widget widget-item">

                    <h4 class="widget-title">Search</h4>
                    <form action="">
                        <input type="text">
                        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                    </form>

                </div><!--/Search Widget -->

                <!-- Recent Posts Widget -->
                <div class="recent-posts-widget widget-item">

                    <h4 class="widget-title">Recent Posts</h4>
                    <?php foreach ($rowRecentBlog as $recentBlog): ?>

                        <div class="post-item">
                            <h6><a
                                    href="?page=blog-detail&id=<?php echo $recentBlog['id'] ?>"><?php echo $recentBlog['title'] ?></a>
                            </h6>
                            <time
                                datetime="2020-01-01"><?php echo date("M d, Y", strtotime($recentBlog['created_at'])) ?></time>
                        </div><!-- End recent post item-->
                    <?php endforeach ?>


                </div><!--/Recent Posts Widget -->

            </div>

        </div>

    </div>
</div>