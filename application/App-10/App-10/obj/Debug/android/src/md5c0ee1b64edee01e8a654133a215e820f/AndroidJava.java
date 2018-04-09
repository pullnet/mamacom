package md5c0ee1b64edee01e8a654133a215e820f;


public class AndroidJava
	extends java.lang.Object
	implements
		mono.android.IGCUserPeer
{
/** @hide */
	public static final String __md_methods;
	static {
		__md_methods = 
			"n_setTitle:(Ljava/lang/String;)V:__export__\n" +
			"";
		mono.android.Runtime.register ("App_10.AndroidJava, App-10, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", AndroidJava.class, __md_methods);
	}


	public AndroidJava ()
	{
		super ();
		if (getClass () == AndroidJava.class)
			mono.android.TypeManager.Activate ("App_10.AndroidJava, App-10, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", "", this, new java.lang.Object[] {  });
	}

	public AndroidJava (android.app.Activity p0)
	{
		super ();
		if (getClass () == AndroidJava.class)
			mono.android.TypeManager.Activate ("App_10.AndroidJava, App-10, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", "Android.App.Activity, Mono.Android, Version=0.0.0.0, Culture=neutral, PublicKeyToken=84e04ff9cfb79065", this, new java.lang.Object[] { p0 });
	}

	@android.webkit.JavascriptInterface

	public void setTitle (java.lang.String p0)
	{
		n_setTitle (p0);
	}

	private native void n_setTitle (java.lang.String p0);

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
