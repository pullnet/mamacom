package md5c0ee1b64edee01e8a654133a215e820f;


public class AdvanceWebViewClient
	extends android.webkit.WebViewClient
	implements
		mono.android.IGCUserPeer
{
/** @hide */
	public static final String __md_methods;
	static {
		__md_methods = 
			"n_onPageFinished:(Landroid/webkit/WebView;Ljava/lang/String;)V:GetOnPageFinished_Landroid_webkit_WebView_Ljava_lang_String_Handler\n" +
			"";
		mono.android.Runtime.register ("App_10.AdvanceWebViewClient, App-10, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", AdvanceWebViewClient.class, __md_methods);
	}


	public AdvanceWebViewClient () throws java.lang.Throwable
	{
		super ();
		if (getClass () == AdvanceWebViewClient.class)
			mono.android.TypeManager.Activate ("App_10.AdvanceWebViewClient, App-10, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", "", this, new java.lang.Object[] {  });
	}

	public AdvanceWebViewClient (android.app.Activity p0) throws java.lang.Throwable
	{
		super ();
		if (getClass () == AdvanceWebViewClient.class)
			mono.android.TypeManager.Activate ("App_10.AdvanceWebViewClient, App-10, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", "Android.App.Activity, Mono.Android, Version=0.0.0.0, Culture=neutral, PublicKeyToken=84e04ff9cfb79065", this, new java.lang.Object[] { p0 });
	}


	public void onPageFinished (android.webkit.WebView p0, java.lang.String p1)
	{
		n_onPageFinished (p0, p1);
	}

	private native void n_onPageFinished (android.webkit.WebView p0, java.lang.String p1);

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
