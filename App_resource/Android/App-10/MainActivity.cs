using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Diagnostics;

using Android;
using Android.App;
using Android.Content;
using Android.OS;
using Android.Net;
using Android.Runtime;
using Android.Views;
using Android.Widget;
using System.IO;
using Android.Webkit;
using Java.Lang;
using Java.Interop;
using Android.Content.Res;
using Android.Provider;

namespace Mamacom_android
{
	[Activity(MainLauncher = true, Label = "ママコムアプリ",ConfigurationChanges = Android.Content.PM.ConfigChanges.Orientation | Android.Content.PM.ConfigChanges.ScreenSize)]
	public class MainActivity : Activity
	{
		public WebView Webs;
		private IValueCallback mUploadMessage;
		private Android.Net.Uri m_uri;
		private static int FILECHOOSER_RESULTCODE = 1;
		private static int RESULT_CAMERA = 1001;
		//private static int REQUEST_CHOOSER = 1000;

		protected override void OnCreate(Bundle bundle)
		{
			base.OnCreate(bundle);

			string urls = "file:///android_asset/html/index.html";

			// Set our view from the "main" layout resource
			SetContentView(Resource.Layout.Main);
			var chrome = new FileChooserWebChromeClient((uploadMsg, acceptType, capture) => {
			
				AlertDialog.Builder AD01 = new AlertDialog.Builder(this, Resource.Style.dialogs);
				AD01.SetTitle("ファイルの選択方法を選んでください");
				string[] items = new string[] { "ギャラリーから選択", "カメラで撮影" };
				AD01.SetItems(items,
					 (sender, args) => {
							 // 選択した値は　　items[args.Which]で取得できます。
							 // チェック状態は　args.IsChecked　で取得できます。
							 string plan = items[args.Which];

						 if (plan == "ギャラリーから選択")
						 {
							 mUploadMessage = uploadMsg;
							 var i = new Intent(Intent.ActionGetContent);
							 i.AddCategory(Intent.CategoryOpenable);
							 i.SetType("image/*");
							 StartActivityForResult(Intent.CreateChooser(i, "File Chooser"), FILECHOOSER_RESULTCODE);
						 }
						 /*
						 else if (plan == "カメラで撮影")
						 {
							 mUploadMessage = uploadMsg;
							 string photoName = JavaSystem.CurrentTimeMillis() + ".jpg";
							 var i = new Intent(MediaStore.ActionImageCapture);

							 ContentValues contentValues = new ContentValues();
							 contentValues.Put(MediaStore.Images.Media.InterfaceConsts.Title, photoName);
							 contentValues.Put(MediaStore.Images.Media.InterfaceConsts.MimeType, "image/jpeg");
							 m_uri = this.ContentResolver.Insert(MediaStore.Images.Media.ExternalContentUri, contentValues);

							 i.PutExtra(MediaStore.ExtraOutput, m_uri);
							 StartActivityForResult(Intent.CreateChooser(i, "Camera Chosser"), RESULT_CAMERA);
						 }
						 */
					 });
				AD01.SetCancelable(false);
				AD01.Show();
			});

			Webs = FindViewById<WebView>(Resource.Id.webView1);
			Webs.SetWebViewClient(new AdvanceWebViewClient(this));
			Webs.SetWebChromeClient(chrome);
			Webs.Settings.DomStorageEnabled = true;
			Webs.Settings.JavaScriptEnabled = true;
			Webs.Settings.UserAgentString = "butene_collabos_beta_0001_20170809";
			Webs.AddJavascriptInterface(new AndroidJava(this), "Android");
			Webs.Settings.LoadWithOverviewMode = true;
			Webs.LoadUrl(urls);
		}
		// 戻るボタンの有効に
		public override bool OnKeyDown(Keycode keyCode, KeyEvent e)
		{
			if (keyCode == Keycode.Back && Webs.CanGoBack())
			{
				Webs.GoBack();

				return true;
			}
			return base.OnKeyDown(keyCode, e);
		}
		public override void OnSaveInstanceState(Bundle outState, PersistableBundle outPersistentState)
		{
			base.OnSaveInstanceState(outState, outPersistentState);
		}
		public override void OnRestoreInstanceState(Bundle savedInstanceState, PersistableBundle persistentState)
		{
			base.OnRestoreInstanceState(savedInstanceState, persistentState);
		}
		public override void OnConfigurationChanged(Configuration newConfig)
		{
			base.OnConfigurationChanged(newConfig);
		}
		protected override void OnActivityResult(int requestCode, Result resultCode, Intent data)
		{
			base.OnActivityResult(requestCode, resultCode, data);

			System.Diagnostics.Debug.WriteLine(requestCode);

			if (resultCode == Result.Ok)
			{
				if (mUploadMessage == null)
				{
					return;
				}

				if (requestCode == RESULT_CAMERA)
				{
					Android.Net.Uri result = m_uri;
					mUploadMessage.OnReceiveValue(result);
					mUploadMessage = null;
				}
				else
				{
					Android.Net.Uri result = (data == null || resultCode != Result.Ok) ? null : data.Data;
					mUploadMessage.OnReceiveValue(result);
					mUploadMessage = null;
				}
			}
			else if (resultCode == Result.Canceled)
			{
				mUploadMessage.OnReceiveValue(null);
				mUploadMessage = null;

			}
		}
		//classの中心でclassを叫ぶ.....？
		partial class FileChooserWebChromeClient : WebChromeClient
		{
			Action<IValueCallback, Java.Lang.String, Java.Lang.String> callback;

			public FileChooserWebChromeClient(Action<IValueCallback, Java.Lang.String, Java.Lang.String> callback)
			{
				this.callback = callback;
			}

			//For Android 4.1
			[Java.Interop.Export]
			public void OpenFileChooser(IValueCallback uploadMsg, Java.Lang.String acceptType, Java.Lang.String capture)
			{
				callback(uploadMsg, acceptType, capture);
			}
		}
	}
	public class AdvanceWebViewClient : WebViewClient
	{
		public Activity ac;

		public AdvanceWebViewClient(Activity AC)
		{
			ac = AC;
		}
		//ページ読み込み完了後....
		public override void OnPageFinished(WebView view, string url)
		{
			base.OnPageFinished(view, url);
		}
		//リンクが電話番号orメールアドレスの場合の手続き
		public override bool ShouldOverrideUrlLoading(WebView view, string url)
		{
			if (url.StartsWith("mailto:") || url.StartsWith("tel:"))
			{
				//電話番号の場合
				if (url.StartsWith("tel:"))
				{
					Intent intent = new Intent(Intent.ActionDial);
					intent.SetData(Android.Net.Uri.Parse(url));
					ac.StartActivity(intent);
					return true;
				}
				//メールの場合(※端末のメーラー設定が必要なので、設定されてなければ「サポートされていません」と表示される)
				else if (url.StartsWith("mailto:"))
				{
					Intent intent = new Intent(Intent.ActionSendto);
					intent.SetData(Android.Net.Uri.Parse(url));
					intent.PutExtra(Intent.ExtraSubject, "");
					intent.PutExtra(Intent.ExtraText, "");
					ac.StartActivity(intent);
					return true;
				}
			}
			else
			{
				view.LoadUrl(url);
			}
			return base.ShouldOverrideUrlLoading(view, url);
		}

	}
}

