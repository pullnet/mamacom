using System;
using System.IO;
using UIKit;

namespace App2_wv
{
    public partial class ViewController : UIViewController
    {
        public ViewController(IntPtr handle) : base(handle)
        {
        }

        public override void ViewDidLoad()
        {
            base.ViewDidLoad();
            var fileName = Path.Combine(Foundation.NSBundle.MainBundle.BundlePath, "Content/index.html");
            wv0001.LoadRequest(new Foundation.NSUrlRequest(new Foundation.NSUrl(fileName, false)));
			//wv0001.LoadRequest(new Foundation.NSUrlRequest(new Foundation.NSUrl("http://192.168.11.17/")));
			wv0001.ScrollView.Bounces = false;

		}

        public override void DidReceiveMemoryWarning()
        {
            base.DidReceiveMemoryWarning();
            // Release any cached data, images, etc that aren't in use.
        }
    }
}