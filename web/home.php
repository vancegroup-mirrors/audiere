<?php
$current_page = 'home';
include 'page_header.inc';
?>

<h2>Overview</h2>

<p>
Audiere is a high-level audio API.  It can play
<a href="http://vorbis.com/">Ogg Vorbis</a>, MP3,
<a href="http://flac.sourceforge.net/">FLAC</a>,
uncompressed WAV, AIFF,
<a href="http://dumb.sourceforge.net/">MOD, S3M, XM, and IT</a> files.
For audio output, Audiere supports DirectSound or WinMM in Windows, OSS
on Linux and Cygwin, and SGI AL on IRIX.
</p>

<p>
Audiere is <a href="http://opensource.org/">open source</a> and
licensed under the <a
href="http://opensource.org/licenses/lgpl-license.html">LGPL</a>.
This means that you may freely use Audiere in commercial products, as
long as you do not modify the source code.  If you do modify Audiere
and release a product that uses your modifications, you must release
your changes to the code under the LGPL as well.
</p>

<p>
Audiere is portable.  It is tested on Windows, Linux-i386,
Cygwin, and IRIX with at least three major compilers.  Most of Audiere
is endian-independent, so I expect it would work with few
modifications on other architectures.
</p>

<h2>News</h2>

<h3>2006.02.13 - Audiere 1.9.4 Released</h3>

<p>It's been about two and a half years since the previous release of
Audiere, and much has happened in that time.  Here are the highlights:</p>

<ul>

<li>Replaced mpegsound with a stand-alone version of the MPEG audio decoder
from ffmpeg's libavcodec library.  The result is an MP3 decoder that is
more portable and works with more MP3 files.  MP3 files are now seekable
as well.  (Matt Campbell)</li>

<li>Added Speex support.</li>

<li>Added support for reading metadata tags from sample sources.  So far,
Vorbis comments are supported, as are ID3v1 and ID3v1.1 tags in MP3 files.
Interface designed with help from Brian Robb and Andy Friesen.</li>

<li>Added callback system for stream stop events.  (Richard Schaaf and
Chad Austin)</li>

<li>Added CD audio support, using the MCI subsystem on Win32/Cygwin and
libcdaudio on Linux.  (Chad Austin and Richard Schaaf)</li>

<li>Added MIDI support through the MCI subsystem on Win32 and Cygwin.
(Chad Austin)</li>

<li>Dramatically reduced the latency of the OSS device.  (Matt Campbell)</li>

<li>Rewrote the Resampler class to use DUMB's cubic interpolation resampler,
resulting in much better resampling for devices such as OSS that use
Audiere's own mixer.  (Matt Campbell)</li>

<li> Added bindings to wxWidgets.  (Emanuel Dejanu)</li>

<li>Fixed a bug in the DirectSound device implementation which significantly
slowed down opening of devices and buffers.  (Matt Campbell)</li>

<li>Added pitchshift to the Python bindings.  (Jason Chu)</li>

<li>Split Doxygen documentation into one for users and one for developers.</li>

</ul>

<p>This release also includes the usual slew of other bug fixes and minor
improvements.  For complete details, please refer to the change log.</p>

<h3>2003.07.15 - Audiere 1.9.3 Released</h3>

<p>
Been six months since the last release...
</p>

<ul>
<li>
Replaced MikMod with an actively-maintained MOD decoding engine: DUMB
(http://dumb.sf.net) Overall, the change is for the better, but there
are a few important changes to be noted:

<ul>
<li>fixed a crash in certain Impulse Tracker files</li>
<li>mod looping now works correctly</li>
<li>some previously-unsupported effects now work</li>
<li>opening a mod stream now takes significantly longer, since
    DUMB builds up an internal seek table, which is currently
    unused</li>
<li>playing mod files now takes roughly five times more CPU time
    than it used to</li>
<li>DUMB works on big-endian architectures (such as MIPS (sgi) and
    PowerPC (mac)), where MikMod did not</li>
<li>DUMB tries to match the exact behavior of the "official"
    trackers (that is, Impulse Tracker, Scream Tracker 3, and Fast
    Tracker), so some mods that sounded fine in ModPlug Tracker or
    Winamp (MikMod) may sound strange.  For example, some of the
    Amstrocity remixes of Squaresoft songs have distortion caused
    by volume range clipping when played in DUMB.</li>
</ul>
</li>

<li>Added AIFF support.</li>

<li>Added support for custom loop points via the LoopPointSource
interface.</li>

<li>SoundEffect objects in SINGLE mode no longer stream from the
sample source.</li>

<li>If a stream is set to repeat, then MOD loop points are honored.
Otherwise, a MOD loop point causes the stream to stop.</li>

<li>The configure script tries to link a small wxWindows application
rather than trusting the existence of wx-config in order to find out
if wxWindows exists.</li>

<li>Made the FLAC decoder use libFLAC instead of libFLAC++.  This
makes it easier to compile on platforms with differing C++ ABIs, such
as IRIX (MIPSPro CC vs. GNU g++).</li>

<li>Removed the VC7 build system.  It's out of date, nobody uses it,
and they could just open the VC6 one in VC7 anyway.</li>

<li>Added setRepeat() and getRepeat() to the SampleSource interface.
This architecture change is required in order to support sample
sources with non-standard looping functionality, such as loop points
within MOD or AIFF files.</li>

<li>Gave wxPlayer a crappy icon.  A better one would be welcome.  :)</li>

<li>Fixed some unaligned reads in the MP3 decoder code, which caused
Audiere on SGI/IRIX to crash.</li>

<li>Fixed some edge cases involving small sounds, DirectSound streams,
and the repeating flag.</li>

<li>Added min_buffer_length device parameter to DirectSound device to
prevent static in very small sounds.</li>

<li>Fixed short bursts of periodic static while decoding MP3s.  it
appears to be a result of the Visual C++ optimizer interacting with
the MP3 decoder code.  (I can't claim that is an optimization bug
yet...  there could be some invalid aliasing going on in the
code.)</li>

<li>Fixed bug where resetting an MP3 input stream would emit a short
burst of static.</li>

<li>Fixed static between repeats in repeatable streams (thanks
valgrind!)</li>

<li>Fixed an exit crash on some systems by adding a CoUninitialize
call to the DirectSound device destructor.</li>

<li>You can now specify what format you are loading for efficiency
reasons.</li>

<li>Fixed a bug in the DirectSound streaming code where you would hear
the beginning of some sounds before they actually stopped.</li>

<li>Added getName() method to AudioDevice.</li>

<li>You can now pass smart pointers straight into API calls, for
example:
<pre>
AudioDevicePtr device = OpenDevice();
OutputStreamPtr sound = OpenSound(device, "blah.wav");
sound->play();
</pre>
</li>

<li>Added support for MemoryFile objects.</li>

<li>Removed support for OpenAL because it was causing compile issues on
systems with different and incompatible versions of OpenAL.</li>

<li>No longer use the MTM or STM mikmod loaders because they crash on
certain wav files.</li>
</ul>

<h3>2003.01.06 - Audiere 1.9.2 Released</h3>

<p>
Another release on the road towards 2.0...  No reason not to upgrade!
</p>

<p>Changes since 1.9.1:</p>

<ul>
<li>many general improvements to wxPlayer</li>
<li>use __declspec instead of def files for mingw compatiblity</li>
<li>build the winmm audio device in Cygwin if it's available</li>
<li>build the DirectSound audio device in Cygwin if it's available</li>
<li>greatly improved linearity of the volume property in the DirectSound device (Mik Popov)</li>
<li>add support for audio device enumeration</li>
<li>enable setting the GLOBAL_FOCUS bit on DS surfaces via the global= device parameter</li>
<li>enable choosing nonstandard DirectSound devices via the device_guid= device parameter</li>
<li>drastic performance increase when using MULTIPLE sound effects</li>
<li>implement volume, panning, and pitch shift on SoundEffect objects</li>
<li>improved latency of SGI audio device</li>
<li>disable Ogg or FLAC if 'configure' can't find them.</li>
</ul>

<h3>2002.10.12 - Audiere 1.9.1 Released</h3>

<p>
This release is a good step towards 2.0, even though it still shouldn't be
considered 100% rock solid.  (It seems to work fine for me though, so go
ahead and download it.)
</p>

<p>
Here is the list of changes since 1.9.0:
</p>

<ul>
<li>added GetSupportedFileFormats for file format enumeration</li>
<li>added audiere-config script which provides version information and external library dependencies</li>
<li>finer synchronization granularity on DirectSound output streams for lower-latency OutputStream calls</li>
<li>increase priority of Audiere update thread on all platforms but Win9x, which deadlocks</li>
<li>MP3 support via splay's mpegsound (thanks to Chad Austin and Jacky Chong)</li>
<li>read 10 MP3 frames for smoother playback on corrupt (?) files</li>
<li>added ClassPtr convenience typedefs so people can use them instead of RefPtr&lt;Class&gt;</li>
<li>the configure script outputs the URLs for required libraries if it can't find them</li>
<li>FLAC support (thanks to Chad Austin and Jacky Chong)</li>
<li>added the SoundEffect convenience class for simple sound playback</li>
<li>added menu item to close wxPlayer so you can close child windows in wxGTK</li>
<li>added pitch shifting to the OutputStream interface</li>
<li>added square wave generation</li>
<li>added white noise generation</li>
<li>added pink noise generation</li>
<li>updated wxPlayer</li>
</ul>

<h3>2002.09.07 (9:11 p.m. CST) - 1.9.0 Release Updated</h3>

<p>
That'll teach me from not testing on Linux before releasing...  I
have updated the download to include a very minor fix which allows
it to compile on Linux.  There was also a stupid mistake in the tutorial
(fixed thanks to Ben Scott).  If you downloaded 1.9.0 earlier, please
download it again.
 </p>

<h3>2002.09.07 - Audiere 1.9.0 Released</h3>

<p>
Finally, it's here!  This is a major release, designed to get the new API
tested before 2.0 is released.  I would say 1.9.0 should be considered beta,
but I feel it is so much better than the last 'stable' release (1.0.4) that
there is no reason not to upgrade.
</p>

<p>
The following is planned for 2.0: 3D spatialization, FLAC support,
MP3 support (again, this time using an LGPL library), supported file
type enumeration, pitch bending and other DSP effects, AIFF support,
and ADPCM compressed WAV support.
</p>

<p>
Here is what changed since 1.0.4:
</p>

<ul>
<li>completely new API, defined in C++</li>
<li>made Audiere objects reference counted</li>
<li>support for seeking within WAV and Ogg Vorbis files</li>
<li>support for preloading sounds instead of always streaming from disk</li>
<li>updated Python, XPCOM, and Java bindings</li>
<li>upgraded to Ogg Vorbis 1.0</li>
<li>major performance improvement in DSOutputStream::isPlaying</li>
<li>Ogg Vorbis decoder now works properly on big-endian architectures</li>
<li>WAV reader works properly on big-endian architectures</li>
<li>general support for big-endian architectures</li>
<li>SGI AL (Audio Library) output support</li>
<li>WinMM output support</li>
<li>new SampleBuffer object for loading a sound once and playing it multiple times</li>
<li>SCons build system for MIPSPro on IRIX</li>
<li>interfaces now use __stdcall on Windows so they are more compliant with COM</li>
<li>completely new wxPlayer</li>
<li>fixed bug on Linux where, the more streams were playing, the lower the overall volume would be</li>
<li>implemented the REAL fix for the DirectSound stream-repeating bug</li>
<li>support for low-pass filters on .it files (enabled DMODE_RESONANCE in mikmod)</li>
<li>readded stereo panning support</li>
<li>switched volume to normalized floats [0, 1] instead of [0, 255]</li>
<li>added a tone generator</li>
</ul>

<h3>2002.06.10 - Audiere 1.0.4 Released</h3>

<p>
Audiere 1.0.4 is out.  This is a relatively minor release, but I highly
recommend that users of 1.0.3 upgrade to this version.  One thing to keep
in mind is that I have removed support for MP3 playback.  See the
<a href="http://cvs.sourceforge.net/cgi-bin/viewcvs.cgi/*checkout*/audiere/audiere/doc/faq.txt">FAQ</a>
for the rationale behind this decision.
</p>

<p>
With the release of 1.0.4 came a "new" web design (copied from
<a href="http://corona.sf.net/">Corona</a>, which was, in turn,
copied from <a href="http://www.scons.org/">SCons</a>).  Complaints?
Praise?  Send <a href="mailto:aegis@aegisknight.org">me</a> e-mail.
</p>

<p>
Here is what changed since 1.0.3.
</p>

<ul>
<li>fixed awful sound repeating bug</li>
<li>removed MP3 support</li>
<li>switched library completely to LGPL</li>
<li>compiles on Debian</li>
<li>compiles with gcc 3</li>
<li>compiles on IRIX (no mikmod or audio output support yet)</li>
<li>correct timing in null output driver</li>
<li>major source tree restructuring</li>
<li>--enable-debug configuration option</li>
<li>added Doxygen support</li>
<li>fixed noisy output in Linux</li>
<li>removed Acoustique, moved decoder architecture into Audiere itself</li>
<li>fixed isPlaying() in OSS output driver</li>
<li>runs on NT4 again</li>
<li>removed DLL output driver</li>
<li>removed null output driver from default list (it must be explicit)</li>
<li>fixed complete hang on context creation in Win9x</li>
<li>support building without DX8</li>
<li>several internal mikmod updates</li>
</ul>

<?php
include 'page_footer.inc';
?>
