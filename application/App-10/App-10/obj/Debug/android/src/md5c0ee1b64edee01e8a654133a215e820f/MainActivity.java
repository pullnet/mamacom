package md5c0ee1b64edee01e8a654133a215e820f;


public class MainActivity
	extends android.app.Activity
	implements
		mono.android.IGCUserPeer
{
/** @hide */
	public static final String __md_methods;
	static {
		__md_methods = 
			"n_onCreate:(Landroid/os/Bundle;)V:GetOnCreate_Landroid_os_Bundle_Handler\n" +
			"n_onKeyDown:(ILandroid/view/KeyEvent;)Z:GetOnKeyDown_ILandroid_view_KeyEvent_Handler\n" +
			"n_onSaveInstanceState:(Landroid/os/Bundle;Landroid/os/PersistableBundle;)V:GetOnSaveInstanceState_Landroid_os_Bundle_Landroid_os_PersistableBundle_Handler\n" +
			"n_onRestoreInstanceState:(Landroid/os/Bundle;Landroid/os/PersistableBundle;)V:GetOnRestoreInstanceState_Landroid_os_Bundle_Landroid_os_PersistableBundle_Handler\n" +
			"n_onConfigurationChanged:(Landroid/content/res/Configuration;)V:GetOnConfigurationChanged_Landroid_content_res_Configuration_Handler\n" +
			"n_onActivityResult:(IILandroid/content/Intent;)V:GetOnActivityResult_IILandroid_content_Intent_Handler\n" +
			"";
		mono.android.Runtime.register ("App_10.MainActivity, App-10, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", MainActivity.class, __md_methods);
	}


	public MainActivity ()
	{
		super ();
		if (getClass () == MainActivity.class)
			mono.android.TypeManager.Activate ("App_10.MainActivity, App-10, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", "", this, new java.lang.Object[] {  });
	}


	public void onCreate (android.os.Bundle p0)
	{
		n_onCreate (p0);
	}

	private native void n_onCreate (android.os.Bundle p0);


	public boolean onKeyDown (int p0, android.view.KeyEvent p1)
	{
		return n_onKeyDown (p0, p1);
	}

	private native boolean n_onKeyDown (int p0, android.view.KeyEvent p1);


	public void onSaveInstanceState (android.os.Bundle p0, android.os.PersistableBundle p1)
	{
		n_onSaveInstanceState (p0, p1);
	}

	private native void n_onSaveInstanceState (android.os.Bundle p0, android.os.PersistableBundle p1);


	public void onRestoreInstanceState (android.os.Bundle p0, android.os.PersistableBundle p1)
	{
		n_onRestoreInstanceState (p0, p1);
	}

	private native void n_onRestoreInstanceState (android.os.Bundle p0, android.os.PersistableBundle p1);


	public void onConfigurationChanged (android.content.res.Configuration p0)
	{
		n_onConfigurationChanged (p0);
	}

	private native void n_onConfigurationChanged (android.content.res.Configuration p0);


	public void onActivityResult (int p0, int p1, android.content.Intent p2)
	{
		n_onActivityResult (p0, p1, p2);
	}

	private native void n_onActivityResult (int p0, int p1, android.content.Intent p2);

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
