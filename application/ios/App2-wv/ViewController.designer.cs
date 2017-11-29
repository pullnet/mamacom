// WARNING
//
// This file has been generated automatically by Visual Studio from the outlets and
// actions declared in your storyboard file.
// Manual changes to this file will not be maintained.
//
using Foundation;
using System;
using System.CodeDom.Compiler;

namespace App2_wv
{
    [Register ("ViewController")]
    partial class ViewController
    {
        [Outlet]
        [GeneratedCode ("iOS Designer", "1.0")]
        UIKit.UIWebView wv0001 { get; set; }

        void ReleaseDesignerOutlets ()
        {
            if (wv0001 != null) {
                wv0001.Dispose ();
                wv0001 = null;
            }
        }
    }
}