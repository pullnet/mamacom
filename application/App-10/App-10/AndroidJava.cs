using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Views;
using Android.Widget;
using Java.Interop;
using Android.Webkit;

namespace App_10
{
	public class AndroidJava:Java.Lang.Object
	{
		public Activity MainAct;

		public AndroidJava(Activity AC)
		{
			MainAct = AC;
		}
		[Export]
		[JavascriptInterface]
		public void setTitle(string titles)
		{

		}
	}
}