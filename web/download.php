<?php
$current_page = 'download';
include 'page_header.inc';
?>

<p>
To be notified when new versions of Audiere are released, sign up for the
<a href="http://lists.sourceforge.net/lists/listinfo/audiere-annc">announcements
mailing list</a>.
</p>

<h3>1.9.4</h3>

<ul>
<?php
download('audiere-1.9.4-win32.zip',   'Win32 Binary Release');
download('audiere-1.9.4.tar.gz',      'UNIX Source Release (.tar.gz)');
download('audiere-1.9.4-src.tar.bz2', 'Source Code Snapshot');
?>
</ul>

<h3>1.9.3</h3>

<ul>
<?php
download('audiere-1.9.3-win32.zip',   'Win32 Binary Release');
download('audiere-1.9.3-sgi.tar.gz',  'SGI Binary Release');
download('audiere-1.9.3.tar.gz',      'UNIX Source Release (.tar.gz)');
download('audiere-1.9.3-src.tar.bz2', 'Source Code Snapshot');
?>
</ul>

<h3>1.9.2</h3>

<ul>
<?php
download('audiere-1.9.2-win32.zip', 'Win32 Binary Release');
download('audiere-1.9.2.tar.gz',    'UNIX Source Release (.tar.gz)');
download('audiere-1.9.2.tar.bz2',   'UNIX Source Release (.tar.bz2)');
download('audiere-1.9.2-src.tbz',   'Source Code Snapshot');
?>
</ul>

<h3>1.9.1</h3>

<ul>
<?php
download('audiere-1.9.1-win32.zip',   'Win32 Binary Release');
download('audiere-1.9.1.tar.gz',      'UNIX Source Release');
download('audiere-1.9.1-src.tbz',     'Source Code Snapshot'); 
?>
</ul>

<h3>1.9.0</h3>

<ul>
<?php
download('audiere-1.9.0-win32.zip',   'Win32 Binary Release');
download('audiere-1.9.0.tar.gz',      'UNIX Source Release');
download('audiere-1.9.0-src.tar.bz2', 'Source Code Snapshot');
?>
</ul>

<h3>Older Files</h3>

<p>
All files are available at the <a
href="http://sourceforge.net/project/showfiles.php?group_id=32783">Audiere
project page</a>.
</p>

<?php
include 'page_footer.inc';
?>
