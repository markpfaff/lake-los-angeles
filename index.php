<?php
/* The MIT License (MIT)
*
* Copyright (c) 2015 Mark Pfaff
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
 */
?>
<?php get_header(); ?>

<div class="journal-container m-header scene_element scene_element--fadeinright">

    <div class="container">

            <div class="blog-container">
                <div>
                    <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                    <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

                    <?php the_content('More &raquo;'); ?>
                    <?php edit_post_link('Edit this entry.', '<p><small>', '</small></p>'); ?>

                    <?php endwhile; ?>
                
                    <ul class="blog-pager">
                        <li>
                            <?php previous_posts_link('<strong> &laquo; Previous Page</strong>'); ?>
                        </li>
                        <li>
                             <?php next_posts_link('<strong> Next Page &raquo; </strong>'); ?>
                        </li>
                    </ul>  
                
                </div>
            </div><!-- /blog-pager -->
  
            <?php endif; ?>

    </div><!-- /container -->
</div><!-- /journal-container -->
<small class="small-label">index.php</small>
<?php get_footer(); ?>