using System;

using UIKit;

namespace mamacom_ios
{
    public partial class ViewController : UIViewController
    {
        public ViewController(IntPtr handle) : base(handle)
        {
        }

        public override void ViewDidLoad()
        {
            base.ViewDidLoad();

            Console.WriteLine("test1");
            // Perform any additional setup after loading the view, typically from a nib.
        }

        public override void DidReceiveMemoryWarning()
        {
            base.DidReceiveMemoryWarning();
            // Release any cached data, images, etc that aren't in use.
        }

        partial void buttonClick(UIButton sender)
        {
            Console.WriteLine("test2");
            label.Text = "Hello Xamarin.iOS World";
        }


    }
}