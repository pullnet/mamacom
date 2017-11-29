package md5c0ee1b64edee01e8a654133a215e820f;


public class MainActivity_FileChooserWebChromeClient
	extends android.webkit.WebChromeClient
	implements
		mono.android.IGCUserPeer
{
/** @hide */
	public static final String __md_methods;
	static {
		__md_methods = 
			"n_OpenFileChooser:(Landroid/webkit/ValueCallback;Ljava/lang/String;Ljava/lang/String;)V:__export__\n" +
			"";
		mono.android.Runtime.register ("App_10.MainActivity+FileChooserWebChromeClient, App-10, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", MainActivity_FileChooserWebChromeClient.class, __md_methods);
	}


	public MainActivity_FileChooserWebChromeClient ()
	{
		super ();
		if (getClass () == MainActivity_FileChooserWebChromeClient.class)
			mono.android.TypeManager.Activate ("App_10.MainActivity+FileChooserWebChromeClient, App-10, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", "", this, new java.lang.Object[] {  });
	}


	public void OpenFileChooser (android.webkit.ValueCallback p0, java.lang.String p1, java.lang.String p2)
	{
		n_OpenFileChooser (p0, p1, p2);
	}

	private native void n_OpenFileChooser (android.webkit.ValueCallback p0, java.lang.String p1, java.lang.String p2);

	private java.util.ArrayList refList;
	public void monodroidAddReference (java.lang.Object obj)
	{
		if (refList == null)
			refList = new java.util.ArrayList ();
		refList.add (obj);
	}

	public void monodroidClearReferences ()
	{
		if (refList != null)
			refList.clear ();
	}
}
