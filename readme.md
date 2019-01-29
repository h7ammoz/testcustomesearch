<h1><a id="Google_Custom_SearchMawdoo3_0"></a>Google Custom Search(Mawdoo3)</h1>
<p>Google Custom Search is a laravel package service provider.</p>
<h3><a id="Installation_2"></a>Installation</h3>
<p>Google Custom Search requires <a href="https://laravel.com/">laravel</a> v5.6+ to run.</p>
<p>Create 3 folders in the root</p>
<pre><code class="language-sh">packages
packages/MyVendor
packages/MyVendor/search
</code></pre>
<p>In the search folder git source code</p>
<pre><code class="language-sh">$ <span class="hljs-built_in">cd</span> packages/MyVendor/search
$ git https://github.com/h7ammoz/testcustomesearch ./
</code></pre>
<p>Load Package main composer.json in the root addd the following</p>
<pre><code class="language-sh"><span class="hljs-string">"psr-4"</span>: {
    <span class="hljs-string">"MyVendor\\Search\\"</span>: <span class="hljs-string">"packages/MyVendor/search/src"</span>,
    ...,
 }
</code></pre>
<p>on your terminal in the root of your app run</p>
<pre><code class="language-sh">composer dump-autoload
</code></pre>
<p>active service provider in our root config/app.php</p>
<pre><code class="language-sh"><span class="hljs-string">'providers'</span> =&gt; [
         ...,
    // Our new package class
    MyVendor\Search\CustomSearchServiceProvider::class,
],
</code></pre>
<p>migration DB in our root</p>
<pre><code class="language-sh">php artisan migrate
</code></pre>
<p>publish vendor in our root</p>
<pre><code class="language-sh">php artisan vendor:publish
choose the number of our providr : MyVendor\Search\CustomSearchServiceProvider 
</code></pre>
